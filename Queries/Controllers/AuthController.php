<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(AuthRequest $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
            'phone_number' => $request->phone_number
        ]);

        $defaultRole = Role::where('name','client')->first();
        if($defaultRole){
            $user->roles()->syncWithoutDetaching([$defaultRole->id]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Your Account has been Created',
            'data' => $user,
            'token' => $token
        ],201);
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password , $user->password)){

            return response()->json([
                'success' => false,
                'message' => 'Incorrect Email or Password',
                'error' => 'The provided credentials are incorrect.'
            ],401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $user_name = User::where('email',$request->email)->first();
        return response()->json([
            'success' => true,
            'message' => 'Welcome ' . $user_name->name,
            'data' => $user,
            'token' => $token
        ],200);
    }

    public function logout(Request $request){

        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'logged out successfully'
        ],200);
    }
}

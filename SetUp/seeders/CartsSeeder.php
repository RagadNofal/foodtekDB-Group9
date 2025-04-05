<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class CartsSeeder extends Seeder
{
    public function run()
    {
        // Retrieve only clients
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name_en', 'client');
        })->pluck('id'); // Fetch only IDs for efficiency

        $items = Item::select('id', 'price')->get();

        // Ensure we have data before proceeding
        if ($clients->isEmpty() || $items->isEmpty()) {
            return;
        }

        $carts = []; // Array to store bulk insert data

        foreach ($clients as $client_id) {
            $randomItems = $items->random(rand(1, 3));

            foreach ($randomItems as $item) {
                $quantity = rand(1, 5);
                $carts[] = [
                    'client_id'   => $client_id,
                    'item_id'     => $item->id,
                    'quantity'    => $quantity,
                    'total_price' => ($item->price ?? 10.00) * $quantity,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
        }

        // Bulk insert cart items in one query
        // if (!empty($carts)) {
        //     DB::table('carts')->insert($carts);
        // }

        if (!empty($carts)) {
            DB::transaction(function () use ($carts) {
                DB::table('carts')->insert($carts);
            });
        }
    }
}

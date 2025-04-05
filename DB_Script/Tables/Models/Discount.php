<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'code',
        'percentage',
        'start_date',
        'end_date',
        'image',
        'limit_amount',
        'status'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function items(){
        return $this->belongsToMany(Item::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}

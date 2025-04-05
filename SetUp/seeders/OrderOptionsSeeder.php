<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Option;

class OrderOptionsSeeder extends Seeder
{
    public function run()
    {
        // Fetch order items and options for linking
        $orderItems = OrderItem::all();
        $options = Option::all();

        // Link options to order items (Many-to-Many relationship)
        foreach ($orderItems as $orderItem) {
            foreach ($options as $option) {
                $orderItem->options()->syncWithoutDetaching([
                    $option->id => ['price' => $option->extra_price],
                ]);
            }
        }
    }
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'Pizza',
                'name_ar' => 'بيتزا',
                'image' => '',
                'is_active' => true,
            ],

            [
                'name_en' => 'Burger',
                'name_ar' => 'برجر',
                'image' => '',
                'is_active' => true,
            ],

            [
                'name_en' => 'Drinks',
                'name_ar' => 'مشروبات',
                'image' => '',
                'is_active' => true,
            ],

            [
                'name_en' => 'Sea Food',
                'name_ar' => 'المأكولات البحرية',
                'image' => '',
                'is_active' => true,
            ],

            [
                'name_en' => 'Dessert',
                'name_ar' => 'حلويات',
                'image' => '',
                'is_active' => true,
            ],
        ];

        // Insert into database
        DB::table('categories')->insert($categories);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => [
                'ar' => 'جلسة أولى',
                'en' => 'First Session'
            ], 'price' => '15.00'
        ]);
    }
}

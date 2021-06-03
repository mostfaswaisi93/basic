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
                'ar' => 'أول',
                'en' => 'First'
            ], 'user_id' => '1'
        ]);
        Category::create([
            'name' => [
                'ar' => 'ثاني',
                'en' => 'Second'
            ], 'user_id' => '1'
        ]);
        Category::create([
            'name' => [
                'ar' => 'ثالث',
                'en' => 'Third'
            ], 'user_id' => '1'
        ]);
    }
}

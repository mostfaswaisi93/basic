<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        Brand::create([
            'name' => [
                'ar' => 'أول',
                'en' => 'First'
            ]
        ]);
        Brand::create([
            'name' => [
                'ar' => 'ثاني',
                'en' => 'Second'
            ]
        ]);
        Brand::create([
            'name' => [
                'ar' => 'ثالث',
                'en' => 'Third'
            ]
        ]);
    }
}

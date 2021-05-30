<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'name' => [
                'ar' => 'جلسة أولى',
                'en' => 'First Session'
            ], 'price' => '15.00'
        ]);
        Service::create([
            'name' => [
                'ar' => 'جلسة ثانية',
                'en' => 'Second Session'
            ], 'price' => '20.00'
        ]);
        Service::create([
            'name' => [
                'ar' => 'جلسة ثالثة',
                'en' => 'Third Session'
            ], 'price' => '25.00'
        ]);
        Service::create([
            'name' => [
                'ar' => 'فحص عام',
                'en' => 'General Examination'
            ], 'price' => '30.00'
        ]);
    }
}

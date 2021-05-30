<?php

namespace Database\Seeders;

use App\Models\Constant;
use Illuminate\Database\Seeder;

class ConstantsTableSeeder extends Seeder
{
    public function run()
    {
        Constant::create([
            'name' => [
                'ar' => 'ذكر',
                'en' => 'Male'
            ], 'type' => 'gender'
        ]);
        Constant::create([
            'name' => [
                'ar' => 'أنثى',
                'en' => 'Female'
            ], 'type' => 'gender'
        ]);
        Constant::create([
            'name' => [
                'ar' => 'غير معروف',
                'en' => 'Unknown'
            ], 'type' => 'blood_group'
        ]);
        Constant::create([
            'name' => [
                'ar' => 'A+',
                'en' => 'A+'
            ], 'type' => 'blood_group'
        ]);
        Constant::create([
            'name' => [
                'ar' => 'A-',
                'en' => 'A-'
            ], 'type' => 'blood_group'
        ]);
        Constant::create([
            'name' => [
                'ar' => 'B+',
                'en' => 'B+'
            ], 'type' => 'blood_group'
        ]);
        Constant::create([
            'name' => [
                'ar' => 'B-',
                'en' => 'B-'
            ], 'type' => 'blood_group'
        ]);
        Constant::create([
            'name' => [
                'ar' => 'O+',
                'en' => 'O+'
            ], 'type' => 'blood_group'
        ]);
        Constant::create([
            'name' => [
                'ar' => 'O-',
                'en' => 'O-'
            ], 'type' => 'blood_group'
        ]);
        Constant::create([
            'name' => [
                'ar' => 'AB+',
                'en' => 'AB+'
            ], 'type' => 'blood_group'
        ]);
        Constant::create([
            'name' => [
                'ar' => 'AB-',
                'en' => 'AB-'
            ], 'type' => 'blood_group'
        ]);
    }
}

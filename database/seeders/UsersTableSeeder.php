<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'first_name'    => 'super',
            'last_name'     => 'admin',
            'username'      => 'super_admin',
            'email'         => 'super@admin.com',
            'password'      => bcrypt('password'),
            'created_at'    => date('Y-m-d'),
            'updated_at'    => date('Y-m-d'),
        ]);

        $user->assignRole('super_admin');

        $user2 = User::create([
            'first_name'    => 'Mustafa',
            'last_name'     => 'Al-Swaisi',
            'username'      => 'mostfaswaisi93',
            'email'         => 'mostfaswaisi93@doctor.com',
            'password'      => bcrypt('password'),
            'created_at'    => date('Y-m-d'),
            'updated_at'    => date('Y-m-d'),
        ]);

        $user2->assignRole('doctor');

        $user3 = User::create([
            'first_name'    => 'Ahmad',
            'last_name'     => 'Ali',
            'username'      => 'ahmadali',
            'email'         => 'ahmadali@secretary.com',
            'password'      => bcrypt('password'),
            'created_at'    => date('Y-m-d'),
            'updated_at'    => date('Y-m-d'),
        ]);

        $user3->assignRole('secretary');
    }
}

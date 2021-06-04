<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::create([
            'first_name'    => 'super',
            'last_name'     => 'admin',
            'email'         => 'super@admin.com',
            'password'      => bcrypt('password'),
            'created_at'    => date('Y-m-d'),
            'updated_at'    => date('Y-m-d'),
        ]);

        $user1->assignRole('super_admin');

        $user2 = User::create([
            'first_name'    => 'Mustafa',
            'last_name'     => 'Al-Swasi',
            'email'         => 'mostfaswaisi93@gmail.com',
            'password'      => bcrypt('password'),
            'created_at'    => date('Y-m-d'),
            'updated_at'    => date('Y-m-d'),
        ]);

        $user2->assignRole('admin');
    }
}

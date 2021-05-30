<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SpatieSeeder::class,
            // ConstantsTableSeeder::class,
            UsersTableSeeder::class,
            // ServicesTableSeeder::class,
            // ContactsTableSeeder::class
        ]);
    }
}

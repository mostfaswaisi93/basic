<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SpatieSeeder::class,
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            BrandsTableSeeder::class,
            // ContactsTableSeeder::class,
        ]);
    }
}

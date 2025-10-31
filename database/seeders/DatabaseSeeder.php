<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategoriesTableSeeder::class,
            PagesTableSeeder::class,  // Ajouté
            ProductsTableSeeder::class, // Ajouté
        ]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Sculptures en Bois',
                'slug' => 'sculptures-bois',
                'description' => 'Sculptures artisanales en bois d\'ébène, acajou et teck'
            ],
            [
                'name' => 'Masques Traditionnels',
                'slug' => 'masques-traditionnels',
                'description' => 'Masques africains authentiques faits main'
            ],
            [
                'name' => 'Meubles Artisanaux',
                'slug' => 'meubles-artisanaux',
                'description' => 'Meubles uniques inspirés du patrimoine africain'
            ],
            [
                'name' => 'Accessoires Décoratifs',
                'slug' => 'accessoires-decoratifs',
                'description' => 'Objets décoratifs en bois et matériaux naturels'
            ]
        ];
        
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
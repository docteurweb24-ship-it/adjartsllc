<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            [
                'title' => 'À Propos',
                'slug' => 'about',
                'content' => '<h2>Notre Histoire</h2>
                <p>ADJ ARTS LLC est née du désir profond de valoriser l\'artisanat africain avec une vision moderne, durable et inclusive. Fondée par <strong>Adjike Rissikathou Tidjani</strong>, d\'origine béninoise, la marque est le fruit d\'un parcours marqué par la résilience, la créativité et l\'ambition.</p>
                
                <h2>Notre Mission</h2>
                <p>Promouvoir l\'artisanat africain authentique et durable en proposant des créations uniques réalisées dans le respect des techniques ancestrales et de l\'environnement.</p>',
                'meta_description' => 'Découvrez l\'histoire d\'ADJ ARTS, marque d\'artisanat africain fondée par Adjike Rissikathou Tidjani',
                'is_active' => true,
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'content' => '<h2>Contactez-nous</h2>
                <p>Nous sommes à votre écoute pour toute question concernant nos produits ou collaborations.</p>
                <p><strong>Email:</strong> contact@adj-arts.com</p>
                <p><strong>WhatsApp:</strong> +229 XX XX XX XX</p>',
                'meta_description' => 'Contactez ADJ ARTS pour vos commandes et questions sur l\'artisanat africain',
                'is_active' => true,
            ]
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
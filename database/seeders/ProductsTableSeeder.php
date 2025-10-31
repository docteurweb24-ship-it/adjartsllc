<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        
        $products = [
            [
                'name' => 'Sculpture Baoulé Traditionnelle',
                'description' => 'Magnifique sculpture en bois d\'ébène réalisée par des artisans ivoiriens. Pièce unique inspirée de la culture Baoulé.',
                'price' => 75000,
                'material' => 'Bois d\'ébène',
                'dimensions' => '25x15x10 cm',
                'featured' => true,
            ],
            [
                'name' => 'Masque Dan de Côte d\'Ivoire',
                'description' => 'Masque traditionnel Dan sculpté à la main. Utilisé lors des cérémonies culturelles et rituelles.',
                'price' => 120000,
                'material' => 'Bois de teck',
                'dimensions' => '30x20x15 cm',
                'featured' => true,
            ],
            [
                'name' => 'Table Basse Akwaba',
                'description' => 'Table basse artisanale avec motifs africains traditionnels. Pièce unique pour décorer votre salon.',
                'price' => 185000,
                'material' => 'Acajou et verre',
                'dimensions' => '80x80x40 cm',
                'featured' => true,
            ],
            [
                'name' => 'Statuette Maternité Yoruba',
                'description' => 'Représentation artistique de la maternité dans la culture Yoruba. Sculpture symbolique et émouvante.',
                'price' => 95000,
                'material' => 'Bois d\'iroko',
                'dimensions' => '35x12x10 cm',
                'featured' => false,
            ],
            [
                'name' => 'Coffret Bijoux Ashanti',
                'description' => 'Coffret à bijoux en bois sculpté avec motifs Ashanti. Parfait pour ranger vos précieux accessoires.',
                'price' => 65000,
                'material' => 'Bois d\'acajou',
                'dimensions' => '20x15x10 cm',
                'featured' => true,
            ],
            [
                'name' => 'Plateau de Service Bénin',
                'description' => 'Plateau de service en bois avec incrustations traditionnelles. Idéal pour recevoir vos invités.',
                'price' => 55000,
                'material' => 'Bois d\'ébène',
                'dimensions' => '40x30x5 cm',
                'featured' => false,
            ]
        ];

        foreach ($products as $productData) {
            $category = $categories->random();
            
            Product::create([
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'price' => $productData['price'],
                'currency' => 'FCFA',
                'material' => $productData['material'],
                'dimensions' => $productData['dimensions'],
                'stock' => rand(1, 20),
                'featured' => $productData['featured'],
                'is_active' => true,
                'category_id' => $category->id,
                'images' => json_encode(['images/products/product-' . rand(1, 6) . '.jpg']),
                'amazon_link' => 'https://www.amazon.com/dp/' . Str::random(10),
            ]);
        }
    }
}
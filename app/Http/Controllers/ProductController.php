<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true); // ← SEULEMENT LES PRODUITS ACTIFS
        
        // Filtrage par catégorie
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        // Filtrage par prix
        if ($request->has('price_range')) {
            switch ($request->price_range) {
                case '0-50000':
                    $query->where('price', '<=', 50000);
                    break;
                case '50000-100000':
                    $query->whereBetween('price', [50000, 100000]);
                    break;
                case '100000+':
                    $query->where('price', '>=', 100000);
                    break;
            }
        }
        
        $products = $query->paginate(12);
        $categories = Category::withCount(['products' => function($query) {
            $query->where('is_active', true); // ← COMPTE SEULEMENT LES PRODUITS ACTIFS
        }])->where('is_active', true)->get();
        
        return view('collections.index', compact('products', 'categories'));
    }
    
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
                         ->where('is_active', true) // ← SEULEMENT SI ACTIF
                         ->firstOrFail();
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true) // ← SEULEMENT LES PRODUITS ACTIFS
            ->limit(4)
            ->get();
            
        return view('collections.show', compact('product', 'relatedProducts'));
    }
}
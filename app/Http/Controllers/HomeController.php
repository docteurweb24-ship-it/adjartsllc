<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Page;
use App\Models\Category; // ← AJOUTER

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('featured', true)
                                  ->where('is_active', true)
                                  ->take(4)
                                  ->get();
        
        $categories = Category::withCount(['products' => function($query) {
            $query->where('is_active', true);
        }])->where('is_active', true)->get(); // ← AJOUTER CETTE LIGNE
        
        $aboutPage = Page::where('slug', 'about')->first();
        
        return view('home', compact('featuredProducts', 'aboutPage', 'categories')); // ← AJOUTER categories
    }
}
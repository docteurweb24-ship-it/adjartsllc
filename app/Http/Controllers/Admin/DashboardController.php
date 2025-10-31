<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Page;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products_count' => Product::count(),
            'categories_count' => Category::count(),
            'pages_count' => Page::count(),
            'featured_products' => Product::where('featured', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
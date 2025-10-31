<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // ← AJOUTER

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // ← AJOUTER
        ]);

        // GESTION DES IMAGES ← AJOUTER TOUTE CETTE PARTIE
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/products', 'public');
                $imagePaths[] = $path;
            }
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'material' => $request->material,
            'dimensions' => $request->dimensions,
            'stock' => $request->stock ?? 0,
            'featured' => $request->has('featured'),
            'is_active' => $request->has('is_active'),
            'category_id' => $request->category_id,
            'amazon_link' => $request->amazon_link,
            'images' => $imagePaths, // ← SAUVEGARDER LES IMAGES
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès');
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        // GESTION DES IMAGES POUR L'ÉDITION ← AJOUTER
        $currentImages = $product->images ?? [];
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/products', 'public');
                $currentImages[] = $path;
            }
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'material' => $request->material,
            'featured' => $request->has('featured'),
            'is_active' => $request->has('is_active'),
            'category_id' => $request->category_id,
            'images' => $currentImages, // ← METTRE À JOUR LES IMAGES
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produit modifié avec succès');
    }

    public function destroy(Product $product)
    {
        // SUPPRIMER LES IMAGES PHYSIQUES ← AJOUTER
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès');
    }
}
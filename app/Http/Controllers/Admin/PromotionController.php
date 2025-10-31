<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Category; // AJOUTER CETTE LIGNE
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderBy('created_at', 'desc')->get();
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        // AJOUTER CETTE LIGNE pour récupérer les catégories
        $categories = Category::all();
        
        return view('admin.promotions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:promotions|max:50',
            'description' => 'required|string|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'starts_at' => 'required|date',
            'expires_at' => 'required|date|after:starts_at',
            'categories' => 'nullable|array', // AJOUTER cette validation si vous utilisez les catégories
            'categories.*' => 'exists:categories,id', // Validation pour chaque catégorie
        ]);

        // Créer la promotion
        $promotion = Promotion::create($request->all());

        // Synchroniser les catégories si elles sont présentes
        if ($request->has('categories')) {
            $promotion->categories()->sync($request->categories);
        }

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion créée avec succès');
    }

    public function edit(Promotion $promotion)
{
    // CORRECTION : Charger les catégories existantes pour cette promotion
    $promotion->load('categories');
    $categories = Category::all();
    
    return view('admin.promotions.edit', compact('promotion', 'categories'));
}

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'code' => 'required|max:50|unique:promotions,code,' . $promotion->id,
            'description' => 'required|string|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'starts_at' => 'required|date',
            'expires_at' => 'required|date|after:starts_at',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Mettre à jour la promotion
        $promotion->update($request->all());

        // Synchroniser les catégories
        $promotion->categories()->sync($request->categories ?? []);

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion modifiée avec succès');
    }

    public function destroy(Promotion $promotion)
    {
        // Détacher les catégories avant suppression
        $promotion->categories()->detach();
        $promotion->delete();
        
        return redirect()->route('admin.promotions.index')->with('success', 'Promotion supprimée avec succès');
    }
}
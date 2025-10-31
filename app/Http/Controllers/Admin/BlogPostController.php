<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('user')->latest()->get();
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        // Gérer l'upload de l'image
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('blog-images', 'public');
            $validated['featured_image'] = $imagePath;
        }

        // Générer le slug
        $validated['slug'] = Str::slug($validated['title']);

        // Associer l'article à l'utilisateur connecté
        $validated['user_id'] = Auth::id();

        // Créer l'article
        BlogPost::create($validated);

        return redirect()->route('admin.blog-posts.index')
                         ->with('success', 'Article créé avec succès!');
    }

    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        // Gérer l'upload de l'image
        if ($request->hasFile('featured_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($blogPost->featured_image) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }
            
            $imagePath = $request->file('featured_image')->store('blog-images', 'public');
            $validated['featured_image'] = $imagePath;
        }

        // Générer le slug si le titre a changé
        if ($blogPost->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $blogPost->update($validated);

        return redirect()->route('admin.blog-posts.index')
                         ->with('success', 'Article mis à jour avec succès!');
    }

    public function destroy(BlogPost $blogPost)
    {
        // Supprimer l'image si elle existe
        if ($blogPost->featured_image) {
            Storage::disk('public')->delete($blogPost->featured_image);
        }

        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')
                         ->with('success', 'Article supprimé avec succès!');
    }
}
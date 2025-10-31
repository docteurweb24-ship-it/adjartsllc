<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('is_published', true)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('is_published', true)
                       ->where('slug', $slug)
                       ->firstOrFail();

        // Récupérer les articles récents (excluant l'article actuel)
        $recentPosts = BlogPost::where('is_published', true)
                              ->where('id', '!=', $post->id)
                              ->orderBy('created_at', 'desc')
                              ->limit(3)
                              ->get();

        return view('blog.show', compact('post', 'recentPosts'));
    }
}
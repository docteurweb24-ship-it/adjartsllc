<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('pages.show', compact('page'));
    }
    
    public function contact()
    {
        return view('pages.contact');
    }
    
    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Ici vous pouvez ajouter l'envoi d'email
        // Mail::to('contact@adj-arts.com')->send(new ContactMessage($request->all()));

        return back()->with('success', 'Votre message a été envoyé avec succès! Nous vous répondrons rapidement.');
    }
}
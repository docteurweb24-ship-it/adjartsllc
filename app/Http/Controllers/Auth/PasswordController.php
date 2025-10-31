<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Traite la tentative de connexion
     */
    public function store(Request $request)
    {
        // Validation des données
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentative de connexion
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Redirection vers le DASHBOARD ADMIN (CORRIGÉ)
            return redirect()->intended(route('admin.dashboard'));
        }

        // Si échec
        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects.',
        ])->onlyInput('email');
    }

    /**
     * Déconnexion
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next, $role = null): Response
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur est connecté
        if (!$user) {
            return redirect()->route('login');
        }

        // Vérifier si l'utilisateur a accès à l'admin
        if (!$user->canAccessAdmin()) {
            abort(403, 'Accès non autorisé à l\'administration.');
        }

        // Vérifier les rôles spécifiques si demandé
        if ($role) {
            $roles = explode('|', $role);
            
            if (!in_array($user->role, $roles)) {
                abort(403, 'Permissions insuffisantes pour cette action.');
            }
        }

        return $next($request);
    }
}
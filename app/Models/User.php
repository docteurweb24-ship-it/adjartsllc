<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email', 
        'password',
        'role',
        'is_active',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    /**
     * Vérifie si l'utilisateur est un administrateur
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est un éditeur
     */
    public function isEditor()
    {
        return $this->role === 'editor';
    }

    /**
     * Vérifie si l'utilisateur est un viewer
     */
    public function isViewer()
    {
        return $this->role === 'viewer';
    }

    /**
     * Vérifie si l'utilisateur a accès à l'admin
     */
    public function canAccessAdmin()
    {
        return in_array($this->role, ['admin', 'editor', 'viewer']) && $this->is_active;
    }

    /**
     * Scope pour les utilisateurs actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour les administrateurs
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }
}
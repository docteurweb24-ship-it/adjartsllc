<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', 
        'discount_percentage',
        'start_date',
        'end_date',
        'is_active',
        'image'
    ];

    // AJOUTEZ CES CASTS
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Votre méthode isValid existe déjà
    public function isValid()
    {
        $now = now();
        
        return $this->is_active && 
               $this->start_date <= $now && 
               $this->end_date >= $now;
    }
}
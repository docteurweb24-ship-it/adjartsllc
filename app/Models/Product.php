<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'material',
        'dimensions',
        'stock',
        'category_id',
        'featured',
        'is_active',
        'amazon_link',
        'images'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'is_active' => 'boolean',
        'images' => 'array',
        'price' => 'decimal:2'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accesseur pour les images (garantit que c'est toujours un tableau)
    public function getImagesAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

    // Première image (image principale)
    public function getMainImageAttribute()
    {
        $images = $this->images;
        return !empty($images) ? $images[0] : null;
    }

    // URLs complètes des images
    public function getImageUrlsAttribute()
    {
        return collect($this->images)->map(function ($image) {
            return asset('storage/' . $image);
        })->toArray();
    }
}
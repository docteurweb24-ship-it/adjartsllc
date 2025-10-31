<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];
    
    public $timestamps = true;

    /**
     * Récupère un paramètre par sa clé
     */
    public static function getValue($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Met à jour ou crée un paramètre
     */
    public static function setValue($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Récupère tous les paramètres sous forme de tableau
     */
    public static function getAllSettings()
    {
        return static::all()->pluck('value', 'key')->toArray();
    }
}
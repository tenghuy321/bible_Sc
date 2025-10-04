<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Catalogues extends Model
{
    protected $table = 'catalogue';
    public $timestamps = false;

    // 🚀 Important for string IDs
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name_en',
        'name_km',
        'image',
        'slug',
    ];

    // Auto-generate cuid-style IDs
    protected static function booted()
    {
        static::creating(function ($catalogues) {
            if (empty($catalogues->id)) {
                // If Laravel 11+, use Str::cuid()
                if (method_exists(Str::class, 'cuid')) {
                    $catalogues->id = (string) Str::cuid();
                } else {
                    // Fallback for Laravel < 11: cuid-like random string
                    $catalogues->id = strtolower(Str::random(25));
                }
            }
        });
    }

    public function catabooks()
    {
        return $this->hasMany(CatalogueBook::class, 'catalogueId');
    }
}

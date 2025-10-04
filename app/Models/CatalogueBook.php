<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class CatalogueBook extends Model
{
    protected $table = 'cataloguebook';
    public $timestamps = false;

    // 🚀 Important for string IDs
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'catalogueId',
        'name_en',
        'name_km',
        'type_en',
        'type_km',
        'size_en',
        'size_km',
        'code',
        'isbn',
        'version',
        'image',
    ];

    // Auto-generate cuid-style IDs
    protected static function booted()
    {
        static::creating(function ($catabook) {
            if (empty($catabook->id)) {
                // If Laravel 11+, use Str::cuid()
                if (method_exists(Str::class, 'cuid')) {
                    $catabook->id = (string) Str::cuid();
                } else {
                    // Fallback for Laravel < 11: cuid-like random string
                    $catabook->id = strtolower(Str::random(25));
                }
            }
        });
    }

    public function catalogue()
    {
        return $this->belongsTo(Catalogues::class, 'catalogueId');
    }
}

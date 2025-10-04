<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $table = 'version';
    public $timestamps = false;

    // 🚀 Important for string IDs
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'titleEn',
        'titleKm',
        'slug',
    ];

    // Auto-generate cuid-style IDs
    protected static function booted()
    {
        static::creating(function ($version) {
            if (empty($version->id)) {
                // If Laravel 11+, use Str::cuid()
                if (method_exists(Str::class, 'cuid')) {
                    $version->id = (string) Str::cuid();
                } else {
                    // Fallback for Laravel < 11: cuid-like random string
                    $version->id = strtolower(Str::random(25));
                }
            }
        });
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'versionId', 'slug');
    }
}

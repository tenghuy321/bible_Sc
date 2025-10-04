<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class ReadingDate extends Model
{
    protected $table = 'readingdate';   // your table name
    protected $primaryKey = 'id';

    public $timestamps = false;

    // 🚀 Important for string IDs
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title_en',
        'title_km',
    ];

    // Auto-generate cuid-style IDs
    protected static function booted()
    {
        static::creating(function ($reading) {
            if (empty($reading->id)) {
                // If Laravel 11+, use Str::cuid()
                if (method_exists(Str::class, 'cuid')) {
                    $reading->id = (string) Str::cuid();
                } else {
                    // Fallback for Laravel < 11: cuid-like random string
                    $reading->id = strtolower(Str::random(25));
                }
            }
        });
    }
}

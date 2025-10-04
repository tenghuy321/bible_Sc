<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Vlog extends Model
{
    protected $table = 'vlog';   // your table name
    protected $primaryKey = 'id';

    public $timestamps = false;

    // 🚀 Important for string IDs
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title_en',
        'title_km',
        'paragraph_en',
        'paragraph_km',
        'video_Url',
    ];

    // Auto-generate cuid-style IDs
    protected static function booted()
    {
        static::creating(function ($vlog) {
            if (empty($vlog->id)) {
                // If Laravel 11+, use Str::cuid()
                if (method_exists(Str::class, 'cuid')) {
                    $vlog->id = (string) Str::cuid();
                } else {
                    // Fallback for Laravel < 11: cuid-like random string
                    $vlog->id = strtolower(Str::random(25));
                }
            }
        });
    }
}

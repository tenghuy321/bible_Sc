<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    public $timestamps = false;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nameEn',
        'nameKm',
        'versionId',
        'slug',
    ];

    protected static function booted()
    {
        static::creating(function ($book) {
            if (empty($book->id)) {
                $book->id = method_exists(Str::class, 'cuid') ? (string) Str::cuid() : strtolower(Str::random(25));
            }
        });
    }

    // Relationship to Version
    public function version()
    {
        return $this->belongsTo(Version::class, 'versionId', 'id');
    }

    // Relationship to Chapters
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'bookId', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapter';
    public $timestamps = false;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'bookId',
        'nameEn',
        'nameKm',
        'contentEn',
        'contentKm',
        'paragraphEn',
        'paragraphKm',
        'titleEn',
        'titleKm',
    ];

    protected static function booted()
    {
        static::creating(function ($chapter) {
            if (empty($chapter->id)) {
                $chapter->id = method_exists(Str::class, 'cuid') ? (string) Str::cuid() : strtolower(Str::random(25));
            }
        });
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'bookId', 'id');
    }
}

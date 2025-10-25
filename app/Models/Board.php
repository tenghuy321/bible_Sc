<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table = 'boards';

    protected $primaryKey = 'id';
    protected $fillable = [
        'title_en',
        'title_kh',
        'content_en',
        'content_kh',
        'image',
    ];
    protected $casts = [
        'image' => 'array'
    ];
}

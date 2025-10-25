<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $table = 'missions';

    protected $primaryKey = 'id';
    protected $fillable = [
        'title_en',
        'title_kh',
        'content_en',
        'content_kh',
        'description_kh',
        'description_en',
        'image',
    ];
    protected $casts = [
        'image' => 'array'
    ];
}

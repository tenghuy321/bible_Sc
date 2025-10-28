<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $primaryKey = 'id';
    protected $fillable = [
        'title_en',
        'title_kh',
        'content_en',
        'content_kh',
        'middle_content_kh',
        'middle_content_en',
        'end_content_kh',
        'end_content_en',
        'image',
        'middle_image',
        'end_image',
    ];
    protected $casts = [
        'image' => 'array',
        'middle_image' => 'array',
        'end_image' => 'array',
    ];
}

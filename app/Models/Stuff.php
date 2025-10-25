<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    protected $table = 'staffs';

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

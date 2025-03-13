<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillabel = [
        'title',
        'writer',
        'user_id',
        'category_id',
        'publisher',
        'year'
    ];
}

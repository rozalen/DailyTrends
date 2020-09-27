<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $table = ‘feeds’;
    protected $fillable = [
        ‘title’,
        ‘body’,
        ‘image’,
        ‘source’,
        ‘publisher’
    ];
}
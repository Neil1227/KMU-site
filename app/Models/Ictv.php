<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ictv extends Model
{
    protected $table = 'ictvs'; //  Add this line

    protected $fillable = [
        'title',
        'description',
        'link',
        'webp',
        'png',
    ];

}

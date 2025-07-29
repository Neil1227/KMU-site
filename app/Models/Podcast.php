<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    protected $table = 'podcasts';

    // Fields that can be mass-assigned
    protected $fillable = [
        'title',
        'description',
        'link',
        'png',
    ];
}

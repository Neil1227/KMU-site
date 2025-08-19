<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = [
        'product',
        'desc',
        'net',
        'profit',
        'image',
        'poster', // ✅ Added poster here
        'inventors',
        'ip_status',
        'proposition',
        'benefits',
    ];

    protected $casts = [
        'inventors' => 'array',
        'proposition' => 'array',
        'benefits' => 'array',
    ];
}

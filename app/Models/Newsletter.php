<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
       use HasFactory;

    protected $fillable = [
        'title',       // ✅ allow mass assignment
        'file',
        'png',
    ];
}

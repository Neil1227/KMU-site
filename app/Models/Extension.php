<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'authors',
        'technology_type',
        'priority_area',
        'link',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredTechnology extends Model
{
    use HasFactory;

    protected $table = 'registered_technologies';

    protected $fillable = [
        'technology',
        'technology_generator',
        'description',
        'link',
    ];
}

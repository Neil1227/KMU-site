<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdg extends Model
{
    use HasFactory;

    protected $table = 'sdgs'; // Optional if table name matches 'sdgs'

    // Mass assignable fields
    protected $fillable = [
        'sdg_number',
        'description',
        'gallery_link',
    ];

    // If you want to cast fields (optional)
    // protected $casts = [
    //     'sdg_number' => 'integer',
    // ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgriBusiness extends Model
{
    use HasFactory;

    // Specify the table (optional if it follows Laravel naming convention)
    protected $table = 'agri_businesses';

    // Columns that are mass assignable
    protected $fillable = [
        'thesis_title',
        'technologies',
        'technology_generator',
        'type_of_technology',
        'contact_info',
        'remarks',
        'link',
    ];
}

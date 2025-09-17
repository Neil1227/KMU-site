<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    use HasFactory;

    protected $fillable = [
        'commodity',
        'thesis_title',
        'technologies',
        'technology_generator',
        'contact_info',
        'type_of_technology',
        'ip_status',
        'trl_level',
        'sdgs',
        'remarks',
        'recommendations',
        'link',
        'priority_area',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commercialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'commodity_id',
        'thesis_title',
        'technologies',
        'technology_generator',
        'contact_info',
        'college',
        'type_of_technology',
        'ip_status',
        'trl_level',
        'sdgs',
        'remarks',
        'recommendations',
        'link',
        'priority_area',
        'pushed_to_promotion', // new
        'pushed_to_agri',      // new
    ];


    public function commodity()
    {
        return $this->belongsTo(Commodity::class);
    }
}

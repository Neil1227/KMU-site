<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbi extends Model
{
    use HasFactory;


    protected $fillable = [
        'thesis_title',
        'technologies',
        'technology_generator',
        'type_of_technology',
        'contact_info',
        'remarks',
        'link',
    ];

    // Relationship back to Commodity (optional)
    public function commodityRef()
    {
        return $this->belongsTo(Commodity::class, 'commodity_id');
    }
}

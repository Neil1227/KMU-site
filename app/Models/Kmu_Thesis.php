<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kmu_Thesis extends Model
{
    use HasFactory;

    protected $table = 'kmu_thesis';

    protected $fillable = [
        'title',
        'authors',
        'technology_type',
        'priority_area',
        'link',
        'status',
    ];
}

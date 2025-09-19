<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DBActivity extends Model
{
    use HasFactory;

    protected $table = 'activities'; // make sure it matches your DB table

    protected $fillable = [
        'action',
        'model',
        'record_id',
        'thesis_title',
        'technology',
        'ip_status',
        'changes',
    ];
}

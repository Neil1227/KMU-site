<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentActivity extends Model
{
    protected $table = 'recent_activities'; // Explicit table name if needed

    protected $fillable = [
        'action',
        'title',
        'source',
    ];

    public $timestamps = true; // created_at and updated_at will be handled by Laravel
}

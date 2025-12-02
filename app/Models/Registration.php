<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'registration_number',
        'title',
        'remarks',
        'date_received',
        'inventor_owner',
        'ip_type',
        'comment',
        'notice',
    ];

    protected $dates = ['date_received'];
}

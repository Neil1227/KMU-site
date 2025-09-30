<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['commodity_id'];

    public function commodity()
    {
        return $this->belongsTo(Commodity::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SDGMedia extends Model
{
    use HasFactory;

    protected $table = 'sdg_media';

    protected $fillable = [
        'sdg_id',
        'title',
        'image',
        'sdg_targets',
    ];

    public function sdg()
    {
        return $this->belongsTo(Sdg::class);
    }
}

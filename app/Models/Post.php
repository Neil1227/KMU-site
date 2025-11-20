<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['admin_id', 'type', 'title', 'description', 'tags'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }


    protected $casts = [
        'tags' => 'array', // automatically convert comma-separated string to array (if you use accessor/mutator)
    ];

    public function media()
    {
        return $this->hasMany(PostMedia::class);
    }

    // Accessor for tags
    public function getTagsAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    // Mutator for tags
    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = is_array($value) ? implode(',', $value) : $value;
    }
}

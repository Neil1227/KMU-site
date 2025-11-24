<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['admin_id', 'type', 'title', 'description', 'tags', 'sdg_target_indicators','link'];


    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }


    protected $casts = [
        'tags' => 'array',
        'sdg_target_indicators' => 'array', // new line
    ];

    // Accessor (optional, Laravel 10+ can do this automatically with $casts)
    public function getSdgTargetIndicatorsAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    // Mutator
    public function setSdgTargetIndicatorsAttribute($value)
    {
        $this->attributes['sdg_target_indicators'] = is_array($value) ? implode(',', $value) : $value;
    }

    // In PostMedia.php
    public function getFilePathAttribute()
    {
        // Assuming your media files are stored in storage/app/public/uploads
        return $this->file_name ? asset('storage/' . $this->file_name) : null;
    }

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

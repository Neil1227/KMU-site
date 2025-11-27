<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    protected $table = 'theses';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'email',
        'fullname',
        'psau_id',
        'contact_number',
        'graduate_student',
        'googledrive_link',
        'college',
        'program',
        'thesis_title',
        'adviser',
        'groupmates',
        'graduation_year',
        'graduation_month', // <-- new field
        'file_path',
        'data_privacy_consent',
    ];

    protected $casts = [
        'graduate_student' => 'boolean',
        'data_privacy_consent' => 'boolean',
        'graduation_month' => 'integer', // <-- cast as integer
    ];
}

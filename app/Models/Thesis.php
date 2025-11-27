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
    'file_path',
    'data_privacy_consent', // <--- new field
];

protected $casts = [
    'graduate_student' => 'boolean',
    'data_privacy_consent' => 'boolean', // <--- cast as boolean
];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ for login/auth
use Spatie\Permission\Traits\HasRoles; // ✅ for roles

class Admin extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'user',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    // ✅ Use correct guard for authentication
    protected $guard_name = 'web';
}

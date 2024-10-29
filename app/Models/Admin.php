<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';  // Menyebutkan tabel yang digunakan

    protected $fillable = [
        'name', 'email', 'username', 'password', 'profile_picture',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

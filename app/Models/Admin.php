<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    protected $table = 'admin';  // Menyebutkan tabel yang digunakan

    protected $fillable = [
        'name', 'email', 'username', 'password', 'profile_picture', 'last_login_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'last_login_at', // Tambahkan ini jika menggunakan last_login_at
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}

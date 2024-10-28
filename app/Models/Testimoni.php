<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

     // Mengizinkan kolom yang bisa diisi
     protected $fillable = [
        'name', 'position', 'image', 'rating', 'testimoni'
    ];

    protected $table = 'testimoni';
}

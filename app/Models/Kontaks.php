<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontaks extends Model
{
    use HasFactory;

    protected $table = 'kontak';
    protected $guarded = [
        'id',
        'kontak',
        'created_at',
        'updated_at'
    ];
}

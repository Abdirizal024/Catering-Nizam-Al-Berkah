<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['menu_id', 'customer_name', 'customer_phone', 'customer_address', 'status', 'quantity', 'total_price'];

    // Relasi dengan Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    
}

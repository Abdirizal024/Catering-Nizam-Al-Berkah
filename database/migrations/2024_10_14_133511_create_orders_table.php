<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained()->onDelete('cascade'); // Relasi ke tabel menus
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->string('status')->default('pending'); // Default status pending
            $table->integer('quantity')->default(1);  // Jumlah item yang dibeli
            $table->decimal('total_price', 15, 2)->nullable();  // Total harga pesanan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

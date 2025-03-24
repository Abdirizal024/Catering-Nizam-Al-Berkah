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
            $table->unsignedBigInteger('menu_id'); // Relasi ke tabel menus
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->string('status')->default('Pending'); // Default status pending
            $table->integer('quantity')->default(1);  // Jumlah item yang dibeli
            $table->decimal('total_price', 15, 2)->nullable();  // Total harga pesanan
            $table->string('payment_method')->nullable(); // Menyimpan metode pembayaran
            $table->string('bank')->nullable();
            $table->string('transaction_id')->nullable(); // Menyimpan ID transaksi Midtrans
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
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

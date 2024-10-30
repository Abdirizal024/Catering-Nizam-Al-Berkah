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
        Schema::create('testimoni', function (Blueprint $table) {
            $table->id(); // Kolom id
            $table->string('name'); // Kolom name
            $table->string('position')->nullable(); // Kolom position
            $table->string('image')->nullable(); // Kolom image
            $table->integer('rating'); // Kolom rating
            $table->text('testimonial'); // Kolom testimonial
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimoni');
    }
};

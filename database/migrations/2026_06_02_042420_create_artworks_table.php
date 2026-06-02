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
        Schema::create('artworks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('moderno');
            $table->string('technique')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('year')->nullable();
            $table->string('availability')->default('Disponible');
            $table->string('price')->default('Cotizacion privada');
            $table->string('image_url')->nullable();
            $table->string('source_url')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artworks');
    }
};

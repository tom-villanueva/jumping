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
        Schema::create('tipo_articulo_talle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_articulo_id')->references('id')->on('tipo_articulos')->onDelete('cascade');
            $table->foreignId('talle_id')->references('id')->on('talle')->onDelete('cascade');

            $table->index('tipo_articulo_id');
            $table->index('talle_id');

            $table->unique(['tipo_articulo_id', 'talle_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tipo_articulo_talle');
    }
};

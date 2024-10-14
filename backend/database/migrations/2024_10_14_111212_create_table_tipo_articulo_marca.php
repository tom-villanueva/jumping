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
        Schema::create('tipo_articulo_marca', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_articulo_id')->references('id')->on('tipo_articulos')->onDelete('cascade');
            $table->foreignId('marca_id')->references('id')->on('marca')->onDelete('cascade');

            $table->index('tipo_articulo_id');
            $table->index('marca_id');

            $table->unique(['tipo_articulo_id', 'marca_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_articulo_marca');
    }
};

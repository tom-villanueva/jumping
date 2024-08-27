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
        //
        Schema::create('reserva_equipo', function(Blueprint $table) {
            $table->id();
            $table->integer('altura')->nullable();
            $table->integer('peso')->nullable();
            $table->integer('num_calzado')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();

            // relaciones
            $table->foreignId('reserva_id')->references('id')->on('reservas')->onDelete('cascade');
            $table->index('reserva_id');

            $table->foreignId('equipo_id')->references('id')->on('equipo')->restrictOnDelete();
            $table->index('equipo_id');

            // estas son redundantes pero es para evitar tener que buscar por fecha
            // cuáles eran los precios y descuentos vigentes.
            $table->foreignId('equipo_precio_id')->references('id')->on('equipo_precio')->nullOnDelete();
            $table->index('equipo_precio_id');

            $table->foreignId('equipo_descuento_id')->nullable()->references('id')->on('equipo_descuento')->restrictOnDelete();
            $table->index('equipo_descuento_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('reserva_equipo_articulo', function(Blueprint $table) {
            $table->id();
            $table->boolean('devuelto')->default(false);

            // relaciones
            $table->foreignId('reserva_equipo_id')->references('id')->on('reserva_equipo')->onDelete('cascade');
            $table->index('reserva_equipo_id');

            $table->foreignId('articulo_id')->references('id')->on('articulo')->onDelete('cascade');
            $table->index('articulo_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop("reserva_equipo_articulo");
        Schema::drop("reserva_equipo");
    }
};

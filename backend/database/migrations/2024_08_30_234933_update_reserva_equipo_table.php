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
        Schema::table('reserva_equipo', function (Blueprint $table) {
            $table->dropForeign('reserva_equipo_equipo_precio_id_foreign');
            $table->dropColumn('equipo_precio_id');
            $table->dropForeign('reserva_equipo_equipo_descuento_id_foreign');
            $table->dropColumn('equipo_descuento_id');
            // $table->dropIndex('equipo_precio_id');
            // $table->dropIndex('equipo_descuento_id');
        });

        Schema::create('reserva_equipo_precio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reserva_equipo_id')->references('id')->on('reserva_equipo')->cascadeOnDelete();
            $table->index('reserva_equipo_id');

            $table->foreignId('equipo_precio_id')->references('id')->on('equipo_precio')->cascadeOnDelete();
            $table->index('equipo_precio_id');

            $table->timestamps();
        });

        Schema::create('reserva_equipo_descuento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reserva_equipo_id')->references('id')->on('reserva_equipo')->cascadeOnDelete();
            $table->index('reserva_equipo_id');

            $table->foreignId('equipo_descuento_id')->references('id')->on('equipo_descuento')->cascadeOnDelete();
            $table->index('equipo_descuento_id');
            
            $table->timestamps();
        });

        Schema::table('equipo_precio', function (Blueprint $table) {
            $table->date('fecha_efectiva');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('reserva_equipo', function (Blueprint $table) {
            $table->foreignId('equipo_precio_id')->references('id')->on('equipo_precio')->nullOnDelete();
            $table->index('equipo_precio_id');
            $table->foreignId('equipo_descuento_id')->nullable()->references('id')->on('equipo_descuento')->restrictOnDelete();
            $table->index('equipo_descuento_id');
        });

        Schema::dropIfExists('reserva_equipo_precio');
        Schema::dropIfExists('reserva_equipo_descuento');
        Schema::table('equipo_precio', function (Blueprint $table) {
            $table->dropColumn('fecha_efectiva');
        });
    }
};

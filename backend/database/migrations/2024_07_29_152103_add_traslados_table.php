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
        Schema::create('traslados', function(Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->date('fecha_desde');
            $table->date('fecha_hasta');

            // relaciones
            $table->foreignId('reserva_id')->references('id')->on('reservas')->onDelete('cascade');
            $table->index('reserva_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop("traslados");
    }
};

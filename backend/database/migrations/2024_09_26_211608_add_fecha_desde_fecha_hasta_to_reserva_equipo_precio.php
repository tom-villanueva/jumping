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
        Schema::table('reserva_equipo_precio', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('precio')->default(0);
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
        });

        Schema::table('reserva_equipo_descuento', function (Blueprint $table) {
            //
            $table->decimal('descuento', 5, 2);
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reserva_equipo_precio', function (Blueprint $table) {
            //
            $table->dropColumn('fecha_desde');
            $table->dropColumn('fecha_hasta');
            $table->dropColumn('precio');
        });

        Schema::table('reserva_equipo_descuento', function (Blueprint $table) {
            //
            $table->dropColumn('fecha_desde');
            $table->dropColumn('fecha_hasta');
            $table->dropColumn('descuento');
        });
    }
};

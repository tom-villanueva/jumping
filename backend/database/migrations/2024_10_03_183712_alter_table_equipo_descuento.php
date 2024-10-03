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
        Schema::table('reserva_equipo_descuento', function (Blueprint $table) {
            //
            $table->date('fecha_desde')->nullable()->change();
            $table->date('fecha_hasta')->nullable()->change();
            $table->integer('dias')->nullable();
        });

        Schema::table('equipo_descuento', function (Blueprint $table) {
            //
            $table->date('fecha_desde')->nullable()->change();
            $table->date('fecha_hasta')->nullable()->change();
            $table->integer('dias')->nullable();
            $table->unique(['equipo_id', 'descuento_id', 'dias']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert changes for 'reserva_equipo_descuento' table
    Schema::table('reserva_equipo_descuento', function (Blueprint $table) {
        // Make 'fecha_desde' and 'fecha_hasta' non-nullable again
        $table->date('fecha_desde')->nullable(false)->change();
        $table->date('fecha_hasta')->nullable(false)->change();

        // Drop the 'dias' column
        $table->dropColumn('dias');
    });

    // Revert changes for 'equipo_descuento' table
    Schema::table('equipo_descuento', function (Blueprint $table) {
        // Make 'fecha_desde' and 'fecha_hasta' non-nullable again
        $table->date('fecha_desde')->nullable(false)->change();
        $table->date('fecha_hasta')->nullable(false)->change();

        // Drop the 'dias' column
        $table->dropColumn('dias');

        // Drop the unique constraint on 'equipo_id', 'descuento_id', and 'dias'
        $table->dropUnique(['equipo_id', 'descuento_id', 'dias']);
    });
    }
};

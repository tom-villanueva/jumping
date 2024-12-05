<?php

use App\Models\Pago;
use App\Models\Reserva;
use App\Models\ReservaEstado;
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
        Schema::table('tipo_persona', function (Blueprint $table) {
            $table->foreignId('descuento_id')->nullable()->change();
        });

        Schema::table('reserva_estado', function (Blueprint $table) {
            $table->dropColumn('reserva_id');

            $table->foreignId('reserva_id')->references('id')->on('reservas')->cascadeOnDelete();
            $table->index('reserva_id');
        });

        Schema::table('pagos', function (Blueprint $table) {
            $table->dropColumn('reserva_id');

            $table->foreignId('reserva_id')->references('id')->on('reservas')->cascadeOnDelete();
            $table->index('reserva_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipo_persona', function (Blueprint $table) {
            // $table->foreignId('descuento_id')->nullable()->change();
        });
    }
};

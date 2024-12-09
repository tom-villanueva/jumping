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
        // Schema::table('tipo_persona', function (Blueprint $table) {
        //     $table->foreignId('descuento_id')->nullable()->change();
        // });

        // Schema::table('reserva_estado', function (Blueprint $table) {
        //     $table->dropColumn('reserva_id');

        //     $table->foreignId('reserva_id')->references('id')->on('reservas')->cascadeOnDelete();
        //     $table->index('reserva_id');
        // });

        // Schema::table('pagos', function (Blueprint $table) {
        //     $table->dropColumn('reserva_id');

        //     $table->foreignId('reserva_id')->references('id')->on('reservas')->cascadeOnDelete();
        //     $table->index('reserva_id');
        // });
        Schema::table('tipo_persona', function (Blueprint $table) {
            $table->foreignId('descuento_id')->nullable()->change();
        });

        Schema::table('reserva_estado', function (Blueprint $table) {
            if (Schema::hasColumn('reserva_estado', 'reserva_id')) {
                $table->dropForeign(['reserva_id']);
                $table->dropColumn('reserva_id');
            }
        });

        Schema::table('reserva_estado', function (Blueprint $table) {
            $table->foreignId('reserva_id')
                ->constrained('reservas')
                ->cascadeOnDelete()
                ->index();
        });

        Schema::table('pagos', function (Blueprint $table) {
            if (Schema::hasColumn('pagos', 'reserva_id')) {
                $table->dropForeign(['reserva_id']);
                $table->dropColumn('reserva_id');
            }
        });

        Schema::table('pagos', function (Blueprint $table) {
            $table->foreignId('reserva_id')
                ->constrained('reservas')
                ->cascadeOnDelete()
                ->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert changes in tipo_persona table
        Schema::table('tipo_persona', function (Blueprint $table) {
            $table->foreignId('descuento_id')->nullable(false)->change();
        });

        // Revert changes in reserva_estado table
        Schema::table('reserva_estado', function (Blueprint $table) {
            $table->dropForeign(['reserva_id']);
            $table->dropIndex(['reserva_id']);
            $table->dropColumn('reserva_id');

            $table->foreignId('reserva_id')
                ->constrained('reservas')
                ->cascadeOnDelete();
        });

        // Revert changes in pagos table
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign(['reserva_id']);
            $table->dropIndex(['reserva_id']);
            $table->dropColumn('reserva_id');

            $table->foreignId('reserva_id')
                ->constrained('reservas')
                ->cascadeOnDelete();
        });
    }
};

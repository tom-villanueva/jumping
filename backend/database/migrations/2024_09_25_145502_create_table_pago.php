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
        Schema::create('monedas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('metodo_pago', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('total')->default(0);
            $table->string('status');
            $table->string('numero_comprobante');

            $table->foreignId('reserva_id')->references('id')->on('reservas')->restrictOnDelete();
            $table->index('reserva_id');
            
            $table->foreignId('moneda_id')->references('id')->on('monedas')->restrictOnDelete();
            $table->index('moneda_id');

            $table->foreignId('metodo_pago_id')->references('id')->on('metodo_pago')->restrictOnDelete();
            $table->index('metodo_pago_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('reserva_pago', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pago_id')->references('id')->on('pagos')->restrictOnDelete();
            $table->index('pago_id');

            $table->foreignId('reserva_id')->references('id')->on('reservas')->restrictOnDelete();
            $table->index('reserva_id');

            $table->unique(['pago_id', 'reserva_id']);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn('estado_id');
        });

        Schema::create('reserva_estado', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_id')->references('id')->on('estados')->restrictOnDelete();
            $table->index('estado_id');

            $table->foreignId('reserva_id')->references('id')->on('reservas')->restrictOnDelete();
            $table->index('reserva_id');

            $table->unique(['estado_id', 'reserva_id']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva_pago');
        Schema::dropIfExists('pagos');
        Schema::dropIfExists('metodo_pago');
        Schema::dropIfExists('monedas');
        Schema::dropIfExists('reserva_estado');

        Schema::table('reservas', function (Blueprint $table) {
            $table->foreignId('estado_id')->default(1)->references('id')->on('estados')->onDelete('cascade');
            $table->index('estado_id');
        });
    }
};

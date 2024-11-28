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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable();
            $table->date('fecha_expiracion');
            $table->integer('dias')->default(0);

            // si está asociado a una reserva, está usado
            $table->foreignId('reserva_id')->nullable()->references('id')->on('reservas')->cascadeOnDelete();
            $table->index('reserva_id');

            $table->foreignId('cliente_id')->nullable()->references('id')->on('clientes')->cascadeOnDelete();
            $table->index('cliente_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('equipo_voucher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('precio')->default(0);

            $table->foreignId('equipo_id')->nullable()->references('id')->on('equipo')->restrictOnDelete();
            $table->index('equipo_id');

            $table->foreignId('voucher_id')->nullable()->references('id')->on('vouchers')->cascadeOnDelete();
            $table->index('voucher_id');

            $table->timestamps();
        });

        Schema::create('traslado_precio_voucher', function (Blueprint $table) {
            $table->id();

            $table->foreignId('traslado_precio_id')->nullable()->references('id')->on('traslado_precio')->restrictOnDelete();
            $table->index('traslado_precio_id');

            $table->foreignId('voucher_id')->nullable()->references('id')->on('vouchers')->cascadeOnDelete();
            $table->index('voucher_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_voucher');
        Schema::dropIfExists('traslado_precio_voucher');
        Schema::dropIfExists('vouchers');
    }
};

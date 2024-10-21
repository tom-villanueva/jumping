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
        Schema::create('tipo_persona', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');

            $table->foreignId('descuento_id')->references('id')->on('descuentos')->restrictOnDelete();
            $table->index('descuento_id');

            $table->timestamps();
        });

        Schema::table('metodo_pago', function (Blueprint $table) {
            $table->foreignId('descuento_id')->nullable()->references('id')->on('descuentos')->restrictOnDelete();
            $table->index('descuento_id');
        });

        Schema::table('pagos', function (Blueprint $table) {
            $table->foreignId('tipo_persona_id')->nullable()->references('id')->on('tipo_persona')->restrictOnDelete();
            $table->index('tipo_persona_id');

            $table->decimal('metodo_pago_descuento', 5, 2)->min(0)->default(0);
            $table->decimal('tipo_persona_descuento', 5, 2)->min(0)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_persona');

        Schema::table('metodo_pago', function (Blueprint $table) {
            $table->dropColumn('descuento_id');
        });

        Schema::table('pagos', function (Blueprint $table) {
            $table->dropColumn('tipo_persona_id');
            $table->dropColumn('metodo_pago_descuento');
            $table->dropColumn('tipo_persona_descuento');
        });
    }
};

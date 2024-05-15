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
        Schema::create("descuentos", function(Blueprint $table) {
            $table->id();
            $table->decimal("valor", 5, 2);
            $table->boolean("tipo_descuento");
            $table->string("descripcion")->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('equipo_descuento', function (Blueprint $table) {
            $table->id();
            $table->date("fecha_desde");
            $table->date("fecha_hasta");
            $table->foreignId('descuento_id')->references('id')->on('descuentos')->onDelete('cascade');
            $table->foreignId('equipo_id')->references('id')->on('equipo')->onDelete('cascade');

            $table->index('descuento_id');
            $table->index('equipo_id');

            $table->unique(['descuento_id', 'equipo_id', 'fecha_desde', 'fecha_hasta']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::drop("descuento");
        Schema::drop("equipo_descuento");
    }
};

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
        Schema::create('estados', function(Blueprint $table) {
            $table->id();
            $table->string('descripcion');

            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('reservas', function(Blueprint $table) {
            $table->id();
            $table->date('fecha_prueba')->nullable();
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->string('comentario')->nullable();

            // datos persona por si no hay user (reserva manual por ejemplo)
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();

            // relaciones
            $table->foreignId('estado_id')->default(1)->references('id')->on('estados')->onDelete('cascade');
            $table->index('estado_id');

            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('articulo', function(Blueprint $table) {
            $table->string('nro_serie')->nullable();
            $table->boolean('disponible')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop("reservas");
        Schema::drop("estados");
        Schema::table('articulo', function(Blueprint $table) {
            $table->dropColumn('nro_serie');
            $table->dropColumn('disponible');
        });
    }
};

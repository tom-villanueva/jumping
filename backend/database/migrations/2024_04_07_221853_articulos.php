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
        Schema::create('tipo_articulos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable(false);
            $table->timestamps();
        });

        Schema::create('talle', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable(false);
            $table->timestamps();
        });

        Schema::create('tipo_articulo_talle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock')->default(0);
            $table->foreignId('tipo_articulo_id')->references('id')->on('tipo_articulos')->onDelete('cascade');
            $table->foreignId('talle_id')->references('id')->on('talle')->onDelete('cascade');

            $table->index('tipo_articulo_id');
            $table->index('talle_id');

            $table->unique(['tipo_articulo_id', 'talle_id']);
            $table->timestamps();
        });

        Schema::create('equipo', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable(false);
            $table->unsignedBigInteger('precio')->default(0);
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });

        Schema::create('equipo_tipo_articulo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_articulo_id')->references('id')->on('tipo_articulos')->onDelete('cascade');
            $table->foreignId('equipo_id')->references('id')->on('equipo')->onDelete('cascade');

            $table->index('tipo_articulo_id');
            $table->index('equipo_id');

            $table->unique(['tipo_articulo_id', 'equipo_id']);
            $table->timestamps();
        });

        Schema::create('articulo', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable(false);
            $table->string('codigo')->nullable(false);
            $table->string('observacion')->nullable();
            $table->foreignId('tipo_articulo_talle_id')->nullable()->references('id')->on('tipo_articulo_talle')->cascadeOnUpdate()->nullOnDelete();

            $table->index('tipo_articulo_talle_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::drop('articulo');
        Schema::drop('tipo_articulo_talle');
        Schema::drop('equipo_tipo_articulo');
        Schema::drop('tipo_articulos');
        Schema::drop('talle');
        Schema::drop('equipo');
    }
};

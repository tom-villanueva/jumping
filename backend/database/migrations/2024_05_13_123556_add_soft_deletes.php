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
        Schema::create('equipo_precio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('precio')->default(0);
            $table->foreignId('equipo_id')->references('id')->on('equipo')->onDelete('cascade');

            $table->index('equipo_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('equipo', function (Blueprint $table) {
            $table->dropColumn('precio');
            $table->softDeletes();
        });

        Schema::table('tipo_articulos', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('talle', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('equipo_tipo_articulo', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('tipo_articulo_talle', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('articulo', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::drop('equipo_precio');

        Schema::table('equipo', function (Blueprint $table) {
            $table->unsignedBigInteger('precio')->default(0);
            $table->dropSoftDeletes();
        });

        Schema::table('tipo_articulos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('talle', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('equipo_tipo_articulo', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('tipo_articulo_talle', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('articulo', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};

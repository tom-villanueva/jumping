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
        Schema::create('tipo_equipos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('equipo', function (Blueprint $table) {
            $table->foreignId('tipo_equipo_id')->nullable()->references('id')->on('tipo_equipos')->nullOnDelete();
            $table->index('tipo_equipo_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipo', function (Blueprint $table) {
            $table->dropForeign('equipo_tipo_equipo_id_foreign');
            $table->dropColumn('tipo_equipo_id');
        });

        Schema::dropIfExists('tipo_equipos');
    }
};

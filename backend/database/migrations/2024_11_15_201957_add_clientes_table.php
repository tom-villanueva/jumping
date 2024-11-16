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
         Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email');
            $table->string('telefono')->nullable();
            $table->date('fecha_nacimiento')->nullable();

            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');

            $table->foreignId('tipo_persona_id')->nullable()->references('id')->on('tipo_persona')->restrictOnDelete();
            $table->index('tipo_persona_id');

            $table->timestamps();
            $table->softDeletes();
        });

        // refactor tabla reservas
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn('nombre');
            $table->dropColumn('apellido');
            $table->dropColumn('email');
            $table->dropColumn('telefono');

            $table->dropColumn('user_id');

            $table->foreignId('cliente_id')->nullable()->references('id')->on('clientes')->onDelete('cascade');
            $table->index('cliente_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('clientes');

        Schema::table('reservas', function (Blueprint $table) {
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();

            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');

            $table->dropForeign('cliente_id');
            $table->dropColumn('cliente_id');
        });
    }
};

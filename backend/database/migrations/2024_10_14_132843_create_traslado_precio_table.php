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
        Schema::create('traslado_precio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('precio')->default(0);
            $table->date('fecha_desde');
            $table->date('fecha_hasta')->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('traslados', function (Blueprint $table) {
            $table->unsignedBigInteger('precio')->default(0);
            $table->foreignId('traslado_precio_id')->references('id')->on('traslado_precio')->restrictOnDelete();

            $table->index('traslado_precio_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traslado_precio');

        Schema::table('traslados', function (Blueprint $table) {
            $table->dropColumn('precio');
            $table->dropColumn('traslado_precio_id');
        });
    }
};

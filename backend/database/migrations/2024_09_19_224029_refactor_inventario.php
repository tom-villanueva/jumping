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
        Schema::create('marca', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable(false)->unique();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('modelo', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable(false)->unique();

            $table->foreignId('marca_id')->references('id')->on('marca')->restrictOnDelete();
            $table->index('marca_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('articulo', function (Blueprint $table) {
            $table->dropColumn('tipo_articulo_talle_id');

            $table->foreignId('tipo_articulo_id')->references('id')->on('tipo_articulos')->restrictOnDelete();
            $table->index('tipo_articulo_id');

            $table->foreignId('talle_id')->references('id')->on('talle')->restrictOnDelete();
            $table->index('talle_id');

            $table->foreignId('marca_id')->references('id')->on('marca')->restrictOnDelete();
            $table->index('marca_id');

            $table->foreignId('modelo_id')->references('id')->on('modelo')->restrictOnDelete();
            $table->index('modelo_id');
        });

        Schema::dropIfExists('tipo_articulo_talle');

        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->integer('stock')->default(0);

            $table->foreignId('tipo_articulo_id')->references('id')->on('tipo_articulos')->restrictOnDelete();
            $table->index('tipo_articulo_id');

            $table->foreignId('talle_id')->references('id')->on('talle')->restrictOnDelete();
            $table->index('talle_id');

            $table->foreignId('marca_id')->references('id')->on('marca')->restrictOnDelete();
            $table->index('marca_id');

            $table->foreignId('modelo_id')->references('id')->on('modelo')->restrictOnDelete();
            $table->index('modelo_id');

            $table->unique(['tipo_articulo_id', 'talle_id', 'marca_id', 'modelo_id']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'inventario' table first, because it depends on other tables
        Schema::dropIfExists('inventario');

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

        // Modify 'articulo' table: restore 'tipo_articulo_talle_id' and drop new foreign keys and columns
        Schema::table('articulo', function (Blueprint $table) {
            // Drop the foreign key constraints first
            $table->dropForeign(['tipo_articulo_id']);
            $table->dropForeign(['talle_id']);
            $table->dropForeign(['marca_id']);
            $table->dropForeign(['modelo_id']);

            // Drop the indexes
            $table->dropIndex(['tipo_articulo_id']);
            $table->dropIndex(['talle_id']);
            $table->dropIndex(['marca_id']);
            $table->dropIndex(['modelo_id']);

            // Drop the new columns
            $table->dropColumn('tipo_articulo_id');
            $table->dropColumn('talle_id');
            $table->dropColumn('marca_id');
            $table->dropColumn('modelo_id');

            // Restore the original 'tipo_articulo_talle_id' column
            $table->foreignId('tipo_articulo_talle_id')->references('id')->on('tipo_articulo_talle')->cascadeOnDelete();
            $table->index('tipo_articulo_talle_id');
        });

        // Drop the 'modelo' table
        Schema::dropIfExists('modelo');

        // Drop the 'marca' table
        Schema::dropIfExists('marca');
    }
};

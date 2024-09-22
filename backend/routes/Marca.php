<?php

use App\Http\Controllers\Marca\GetMarcaController;
use App\Http\Controllers\Marca\GetByIdMarcaController;
use App\Http\Controllers\Marca\StoreMarcaController;
use App\Http\Controllers\Marca\UpdateMarcaController;
use App\Http\Controllers\Marca\DeleteMarcaController;

Route::group(['prefix' => 'marcas', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetMarcaController::class);
    Route::get('/{id}', GetByIdMarcaController::class);
    Route::post('/', StoreMarcaController::class);
    Route::put('/{id}', UpdateMarcaController::class);
    Route::delete('/{id}', DeleteMarcaController::class);
});
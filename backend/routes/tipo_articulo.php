<?php

use App\Http\Controllers\TipoArticulo\GetTipoArticulosController;
use App\Http\Controllers\TipoArticulo\GetTipoArticuloByIdController;
use App\Http\Controllers\TipoArticulo\StoreTipoArticuloController;
use App\Http\Controllers\TipoArticulo\UpdateTipoArticuloController;
use App\Http\Controllers\TipoArticulo\DeleteTipoArticuloController;

Route::group(['prefix' => 'tipo-articulos'], function () {
    Route::get('/', GetTipoArticulosController::class);
    Route::get('/{id}', GetTipoArticuloByIdController::class);
    Route::post('/', StoreTipoArticuloController::class);
    Route::put('/{id}', UpdateTipoArticuloController::class);
    Route::delete('/{id}', DeleteTipoArticuloController::class);
});
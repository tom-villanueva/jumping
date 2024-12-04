<?php

use App\Http\Controllers\TipoEquipo\GetTipoEquipoController;
use App\Http\Controllers\TipoEquipo\GetByIdTipoEquipoController;
use App\Http\Controllers\TipoEquipo\StoreTipoEquipoController;
use App\Http\Controllers\TipoEquipo\UpdateTipoEquipoController;
use App\Http\Controllers\TipoEquipo\DeleteTipoEquipoController;

Route::group(['prefix' => 'tipo-equipos', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetTipoEquipoController::class);
    Route::get('/{id}', GetByIdTipoEquipoController::class);
    Route::post('/', StoreTipoEquipoController::class);
    Route::put('/{id}', UpdateTipoEquipoController::class);
    Route::delete('/{id}', DeleteTipoEquipoController::class);
});
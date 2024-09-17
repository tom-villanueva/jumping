<?php

use App\Http\Controllers\ReservaEquipoArticulo\GetReservaEquipoArticuloController;
use App\Http\Controllers\ReservaEquipoArticulo\GetByIdReservaEquipoArticuloController;
use App\Http\Controllers\ReservaEquipoArticulo\StoreReservaEquipoArticuloController;
use App\Http\Controllers\ReservaEquipoArticulo\UpdateReservaEquipoArticuloController;
use App\Http\Controllers\ReservaEquipoArticulo\DeleteReservaEquipoArticuloController;
use App\Http\Controllers\ReservaEquipoArticulo\DevolverAllReservaEquipoArticuloController;

Route::group(['prefix' => 'reserva-equipo-articulos', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetReservaEquipoArticuloController::class);
    Route::get('/{id}', GetByIdReservaEquipoArticuloController::class);
    Route::post('/', StoreReservaEquipoArticuloController::class);
    Route::put('/devolver-todos/{id}', DevolverAllReservaEquipoArticuloController::class);
    Route::put('/{id}', UpdateReservaEquipoArticuloController::class);
    Route::delete('/{id}', DeleteReservaEquipoArticuloController::class);
});
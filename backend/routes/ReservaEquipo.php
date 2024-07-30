<?php

use App\Http\Controllers\ReservaEquipo\GetReservaEquipoController;
use App\Http\Controllers\ReservaEquipo\GetByIdReservaEquipoController;
use App\Http\Controllers\ReservaEquipo\StoreReservaEquipoController;
use App\Http\Controllers\ReservaEquipo\UpdateReservaEquipoController;
use App\Http\Controllers\ReservaEquipo\DeleteReservaEquipoController;

Route::group(['prefix' => 'reserva-equipos', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetReservaEquipoController::class);
    Route::get('/{id}', GetByIdReservaEquipoController::class);
    Route::post('/', StoreReservaEquipoController::class);
    Route::put('/{id}', UpdateReservaEquipoController::class);
    Route::delete('/{id}', DeleteReservaEquipoController::class);
});
<?php

use App\Http\Controllers\Reserva\GetReservaController;
use App\Http\Controllers\Reserva\GetByIdReservaController;
use App\Http\Controllers\Reserva\StoreReservaController;
use App\Http\Controllers\Reserva\UpdateReservaController;
use App\Http\Controllers\Reserva\DeleteReservaController;

Route::group(['prefix' => 'reservas', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetReservaController::class);
    Route::get('/{id}', GetByIdReservaController::class);
    Route::post('/', StoreReservaController::class);
    Route::put('/{id}', UpdateReservaController::class);
    Route::delete('/{id}', DeleteReservaController::class);
});
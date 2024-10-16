<?php

use App\Http\Controllers\Reserva\GetReservaController;
use App\Http\Controllers\Reserva\GetByIdReservaController;
use App\Http\Controllers\Reserva\StoreReservaController;
use App\Http\Controllers\Reserva\UpdateReservaController;
use App\Http\Controllers\Reserva\DeleteReservaController;
use App\Http\Controllers\Reserva\ExtenderFechasReservaController;
use App\Http\Controllers\Reserva\ExtenderReservaController;
use App\Http\Controllers\Reserva\GetEstadisticasReservasController;
use App\Http\Controllers\Reserva\MarcarReservaPagadaController;

Route::group(['prefix' => 'reservas', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetReservaController::class);
    Route::get('/estadisticas', GetEstadisticasReservasController::class);
    Route::get('/{id}', GetByIdReservaController::class);
    Route::post('/', StoreReservaController::class);
    Route::put('/marcar-pagada/{id}', MarcarReservaPagadaController::class);
    Route::put('/extender/{id}', ExtenderReservaController::class);
    Route::put('/extender-fechas/{id}', ExtenderFechasReservaController::class);
    Route::put('/{id}', UpdateReservaController::class);
    Route::delete('/{id}', DeleteReservaController::class);
});
<?php

use App\Http\Controllers\Clientes\GetEquiposByFechasController;
use App\Http\Controllers\Clientes\GetMisReservasController;
use App\Http\Controllers\Clientes\StoreReservaClienteController;
use App\Http\Controllers\TipoEquipo\GetTipoEquipoController;

Route::group(['prefix' => 'clientes', 'middleware' => 'throttle:10,1'], function () {
    Route::get('/equipos', GetEquiposByFechasController::class);
    Route::get('/tipo-equipos', GetTipoEquipoController::class);

    Route::middleware('auth:web')->get('/mis-reservas', GetMisReservasController::class);

    Route::post('/reserva', StoreReservaClienteController::class);
});
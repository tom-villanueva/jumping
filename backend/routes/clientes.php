<?php

use App\Http\Controllers\Clientes\GetEquiposByFechasController;
use App\Http\Controllers\Clientes\StoreReservaClienteController;
use App\Http\Controllers\TipoEquipo\GetTipoEquipoController;

Route::group(['prefix' => 'clientes'], function () {
    Route::get('/equipos', GetEquiposByFechasController::class);
    Route::get('/tipo-equipos', GetTipoEquipoController::class);
    Route::middleware('throttle:10,1')->post('/reserva', StoreReservaClienteController::class);
});
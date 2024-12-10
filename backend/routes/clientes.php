<?php

use App\Http\Controllers\Clientes\GetEquiposByFechasController;
use App\Http\Controllers\Clientes\StoreReservaClienteController;

Route::group(['prefix' => 'clientes'], function () {
    Route::get('/equipos', GetEquiposByFechasController::class);
    Route::middleware('throttle:10,1')->post('/reserva', StoreReservaClienteController::class);
});
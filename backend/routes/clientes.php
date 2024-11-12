<?php

use App\Http\Controllers\Clientes\GetEquiposByFechasController;
use App\Http\Controllers\Clientes\StoreReservaClienteController;

Route::group(['prefix' => 'clientes'], function () {
    Route::get('/equipos', GetEquiposByFechasController::class);
    Route::post('/reserva', StoreReservaClienteController::class);
});
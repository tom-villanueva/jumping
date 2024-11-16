<?php

use App\Http\Controllers\Cliente\GetClienteController;
use App\Http\Controllers\Cliente\GetByIdClienteController;
use App\Http\Controllers\Cliente\StoreClienteController;
use App\Http\Controllers\Cliente\UpdateClienteController;
use App\Http\Controllers\Cliente\DeleteClienteController;

Route::group(['prefix' => 'clientes', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetClienteController::class);
    Route::get('/{id}', GetByIdClienteController::class);
    Route::post('/', StoreClienteController::class);
    Route::put('/{id}', UpdateClienteController::class);
    Route::delete('/{id}', DeleteClienteController::class);
});
<?php

use App\Http\Controllers\MetodoPago\GetMetodoPagoController;
use App\Http\Controllers\MetodoPago\GetByIdMetodoPagoController;
use App\Http\Controllers\MetodoPago\StoreMetodoPagoController;
use App\Http\Controllers\MetodoPago\UpdateMetodoPagoController;
use App\Http\Controllers\MetodoPago\DeleteMetodoPagoController;

Route::group(['prefix' => 'metodo-pagos', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetMetodoPagoController::class);
    Route::get('/{id}', GetByIdMetodoPagoController::class);
    Route::post('/', StoreMetodoPagoController::class);
    Route::put('/{id}', UpdateMetodoPagoController::class);
    Route::delete('/{id}', DeleteMetodoPagoController::class);
});
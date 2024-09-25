<?php

use App\Http\Controllers\Pago\GetPagoController;
use App\Http\Controllers\Pago\GetByIdPagoController;
use App\Http\Controllers\Pago\StorePagoController;
use App\Http\Controllers\Pago\UpdatePagoController;
use App\Http\Controllers\Pago\DeletePagoController;

Route::group(['prefix' => 'pagos', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetPagoController::class);
    Route::get('/{id}', GetByIdPagoController::class);
    Route::post('/', StorePagoController::class);
    Route::put('/{id}', UpdatePagoController::class);
    Route::delete('/{id}', DeletePagoController::class);
});
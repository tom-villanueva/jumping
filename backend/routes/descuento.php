<?php

use App\Http\Controllers\Descuento\GetDescuentosController;
use App\Http\Controllers\Descuento\GetDescuentoByIdController;
use App\Http\Controllers\Descuento\StoreDescuentoController;
use App\Http\Controllers\Descuento\UpdateDescuentoController;
use App\Http\Controllers\Descuento\DeleteDescuentoController;

Route::group(['prefix' => 'descuentos'], function () {
    Route::get('/', GetDescuentosController::class);
    Route::get('/{id}', GetDescuentoByIdController::class);
    Route::post('/', StoreDescuentoController::class);
    Route::put('/{id}', UpdateDescuentoController::class);
    Route::delete('/{id}', DeleteDescuentoController::class);
});
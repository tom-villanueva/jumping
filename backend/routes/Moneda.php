<?php

use App\Http\Controllers\Moneda\GetMonedaController;
use App\Http\Controllers\Moneda\GetByIdMonedaController;
use App\Http\Controllers\Moneda\StoreMonedaController;
use App\Http\Controllers\Moneda\UpdateMonedaController;
use App\Http\Controllers\Moneda\DeleteMonedaController;

Route::group(['prefix' => 'monedas'], function () {
    Route::get('/', GetMonedaController::class);
    // Route::get('/{id}', GetByIdMonedaController::class);
    // Route::post('/', StoreMonedaController::class);
    // Route::put('/{id}', UpdateMonedaController::class);
    // Route::delete('/{id}', DeleteMonedaController::class);
});
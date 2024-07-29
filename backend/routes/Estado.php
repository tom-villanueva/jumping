<?php

use App\Http\Controllers\Estado\GetEstadoController;
use App\Http\Controllers\Estado\GetByIdEstadoController;
use App\Http\Controllers\Estado\StoreEstadoController;
use App\Http\Controllers\Estado\UpdateEstadoController;
use App\Http\Controllers\Estado\DeleteEstadoController;

Route::group(['prefix' => 'estados', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetEstadoController::class);
    Route::get('/{id}', GetByIdEstadoController::class);
    Route::post('/', StoreEstadoController::class);
    Route::put('/{id}', UpdateEstadoController::class);
    Route::delete('/{id}', DeleteEstadoController::class);
});
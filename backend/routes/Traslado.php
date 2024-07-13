<?php

use App\Http\Controllers\Traslado\GetTrasladoController;
use App\Http\Controllers\Traslado\GetByIdTrasladoController;
use App\Http\Controllers\Traslado\StoreTrasladoController;
use App\Http\Controllers\Traslado\UpdateTrasladoController;
use App\Http\Controllers\Traslado\DeleteTrasladoController;

Route::group(['prefix' => 'traslados', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetTrasladoController::class);
    Route::get('/{id}', GetByIdTrasladoController::class);
    Route::post('/', StoreTrasladoController::class);
    Route::put('/{id}', UpdateTrasladoController::class);
    Route::delete('/{id}', DeleteTrasladoController::class);
});
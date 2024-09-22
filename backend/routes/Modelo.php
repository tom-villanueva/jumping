<?php

use App\Http\Controllers\Modelo\GetModeloController;
use App\Http\Controllers\Modelo\GetByIdModeloController;
use App\Http\Controllers\Modelo\StoreModeloController;
use App\Http\Controllers\Modelo\UpdateModeloController;
use App\Http\Controllers\Modelo\DeleteModeloController;

Route::group(['prefix' => 'modelos', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetModeloController::class);
    Route::get('/{id}', GetByIdModeloController::class);
    Route::post('/', StoreModeloController::class);
    Route::put('/{id}', UpdateModeloController::class);
    Route::delete('/{id}', DeleteModeloController::class);
});
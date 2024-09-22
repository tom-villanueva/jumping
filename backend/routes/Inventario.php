<?php

use App\Http\Controllers\Inventario\GetInventarioController;
use App\Http\Controllers\Inventario\GetByIdInventarioController;
use App\Http\Controllers\Inventario\StoreInventarioController;
use App\Http\Controllers\Inventario\UpdateInventarioController;
use App\Http\Controllers\Inventario\DeleteInventarioController;

Route::group(['prefix' => 'inventarios', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetInventarioController::class);
    Route::get('/{id}', GetByIdInventarioController::class);
    Route::post('/', StoreInventarioController::class);
    Route::put('/{id}', UpdateInventarioController::class);
    Route::delete('/{id}', DeleteInventarioController::class);
});
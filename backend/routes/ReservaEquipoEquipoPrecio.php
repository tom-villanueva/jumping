<?php

use App\Http\Controllers\ReservaEquipoEquipoPrecio\GetReservaEquipoEquipoPrecioController;
use App\Http\Controllers\ReservaEquipoEquipoPrecio\GetByIdReservaEquipoEquipoPrecioController;
use App\Http\Controllers\ReservaEquipoEquipoPrecio\StoreReservaEquipoEquipoPrecioController;
use App\Http\Controllers\ReservaEquipoEquipoPrecio\UpdateReservaEquipoEquipoPrecioController;
use App\Http\Controllers\ReservaEquipoEquipoPrecio\DeleteReservaEquipoEquipoPrecioController;

Route::group(['prefix' => 'reserva-equipo-equipo-precios', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetReservaEquipoEquipoPrecioController::class);
    Route::get('/{id}', GetByIdReservaEquipoEquipoPrecioController::class);
    Route::post('/', StoreReservaEquipoEquipoPrecioController::class);
    Route::put('/{id}', UpdateReservaEquipoEquipoPrecioController::class);
    Route::delete('/{id}', DeleteReservaEquipoEquipoPrecioController::class);
});
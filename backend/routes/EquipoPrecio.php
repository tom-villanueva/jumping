<?php

use App\Http\Controllers\EquipoPrecio\GetEquipoPrecioController;
use App\Http\Controllers\EquipoPrecio\GetByIdEquipoPrecioController;
use App\Http\Controllers\EquipoPrecio\StoreEquipoPrecioController;
use App\Http\Controllers\EquipoPrecio\UpdateEquipoPrecioController;
use App\Http\Controllers\EquipoPrecio\DeleteEquipoPrecioController;

Route::group(['prefix' => 'equipo-precios', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetEquipoPrecioController::class);
    Route::get('/{id}', GetByIdEquipoPrecioController::class);
    Route::post('/', StoreEquipoPrecioController::class);
    Route::put('/{id}', UpdateEquipoPrecioController::class);
    Route::delete('/{id}', DeleteEquipoPrecioController::class);
});
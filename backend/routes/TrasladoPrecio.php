<?php

use App\Http\Controllers\TrasladoPrecio\GetTrasladoPrecioController;
use App\Http\Controllers\TrasladoPrecio\GetByIdTrasladoPrecioController;
use App\Http\Controllers\TrasladoPrecio\StoreTrasladoPrecioController;
use App\Http\Controllers\TrasladoPrecio\UpdateTrasladoPrecioController;
use App\Http\Controllers\TrasladoPrecio\DeleteTrasladoPrecioController;

Route::group(['prefix' => 'traslado-precios', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetTrasladoPrecioController::class);
    Route::get('/{id}', GetByIdTrasladoPrecioController::class);
    Route::post('/', StoreTrasladoPrecioController::class);
    Route::put('/{id}', UpdateTrasladoPrecioController::class);
    Route::delete('/{id}', DeleteTrasladoPrecioController::class);
});
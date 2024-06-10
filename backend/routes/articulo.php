<?php

use App\Http\Controllers\Articulo\GetArticulosController;
use App\Http\Controllers\Articulo\GetArticuloByIdController;
use App\Http\Controllers\Articulo\StoreArticuloController;
use App\Http\Controllers\Articulo\UpdateArticuloController;
use App\Http\Controllers\Articulo\DeleteArticuloController;

Route::group(['prefix' => 'articulos', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetArticulosController::class);
    Route::get('/{id}', GetArticuloByIdController::class);
    Route::post('/', StoreArticuloController::class);
    Route::put('/{id}', UpdateArticuloController::class);
    Route::delete('/{id}', DeleteArticuloController::class);
});
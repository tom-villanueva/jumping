<?php

use App\Http\Controllers\TrasladoAsiento\CheckTrasladoAsientoDisponibleController;
use App\Http\Controllers\TrasladoAsiento\GetTrasladoAsientoController;
use App\Http\Controllers\TrasladoAsiento\GetByIdTrasladoAsientoController;
use App\Http\Controllers\TrasladoAsiento\StoreTrasladoAsientoController;
use App\Http\Controllers\TrasladoAsiento\UpdateTrasladoAsientoController;
use App\Http\Controllers\TrasladoAsiento\DeleteTrasladoAsientoController;

Route::group(['prefix' => 'traslado-asientos'], function () {
    Route::get('/', GetTrasladoAsientoController::class);
    Route::get('/check-disponibles', CheckTrasladoAsientoDisponibleController::class);
    Route::get('/{id}', GetByIdTrasladoAsientoController::class);
    Route::post('/', StoreTrasladoAsientoController::class);
    Route::put('/{id}', UpdateTrasladoAsientoController::class);
    Route::delete('/{id}', DeleteTrasladoAsientoController::class);
});
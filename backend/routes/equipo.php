<?php

use App\Http\Controllers\Equipo\GetEquiposController;
use App\Http\Controllers\Equipo\GetEquipoByIdController;
use App\Http\Controllers\Equipo\StoreEquipoController;
use App\Http\Controllers\Equipo\UpdateEquipoController;
use App\Http\Controllers\Equipo\DeleteEquipoController;

Route::group(['prefix' => 'equipos'], function () {
    Route::get('/', GetEquiposController::class);
    Route::get('/{id}', GetEquipoByIdController::class);
    Route::post('/', StoreEquipoController::class);
    Route::put('/{id}', UpdateEquipoController::class);
    Route::delete('/{id}', DeleteEquipoController::class);
});
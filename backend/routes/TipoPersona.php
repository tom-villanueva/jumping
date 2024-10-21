<?php

use App\Http\Controllers\TipoPersona\GetTipoPersonaController;
use App\Http\Controllers\TipoPersona\GetByIdTipoPersonaController;
use App\Http\Controllers\TipoPersona\StoreTipoPersonaController;
use App\Http\Controllers\TipoPersona\UpdateTipoPersonaController;
use App\Http\Controllers\TipoPersona\DeleteTipoPersonaController;

Route::group(['prefix' => 'tipo-personas', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetTipoPersonaController::class);
    Route::get('/{id}', GetByIdTipoPersonaController::class);
    Route::post('/', StoreTipoPersonaController::class);
    Route::put('/{id}', UpdateTipoPersonaController::class);
    Route::delete('/{id}', DeleteTipoPersonaController::class);
});
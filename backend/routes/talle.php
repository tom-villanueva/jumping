<?php

use App\Http\Controllers\Talle\GetTallesController;
use App\Http\Controllers\Talle\GetTalleByIdController;
use App\Http\Controllers\Talle\StoreTalleController;
use App\Http\Controllers\Talle\UpdateTalleController;
use App\Http\Controllers\Talle\DeleteTalleController;

Route::group(['prefix' => 'talles', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetTallesController::class);
    Route::get('/{id}', GetTalleByIdController::class);
    Route::post('/', StoreTalleController::class);
    Route::put('/{id}', UpdateTalleController::class);
    Route::delete('/{id}', DeleteTalleController::class);
});
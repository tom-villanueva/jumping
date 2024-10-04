<?php

use App\Http\Controllers\User\GetUsersController;
use App\Http\Controllers\User\UpdateUserController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\User\StoreUserController;

Route::group(['prefix' => 'users', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetUsersController::class);
    Route::post('/', StoreUserController::class);
    Route::put('/{id}', UpdateUserController::class);
    Route::delete('/{id}', DeleteUserController::class);
});
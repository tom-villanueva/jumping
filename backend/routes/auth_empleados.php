<?php

use App\Http\Controllers\Empleados\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Empleados\Auth\NewPasswordController;
use App\Http\Controllers\Empleados\Auth\PasswordResetLinkController;
use App\Http\Controllers\Empleados\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('empleados')->group(function(){
    Route::post('/register', [RegisteredUserController::class, 'store'])
                    ->middleware('guest:empleado')
                    ->name('register.empleado');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                    ->middleware('guest:empleado')  
                    ->name('login.empleado');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                    ->middleware('guest:empleado')
                    ->name('password.email.empleado');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
                    ->middleware('guest:empleado')
                    ->name('password.store.empleado');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->middleware('auth:empleado')
                    ->name('logout.empleado');
});

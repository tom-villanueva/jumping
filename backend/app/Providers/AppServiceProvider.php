<?php

namespace App\Providers;

use App\Models\Articulo;
use App\Models\ReservaEquipoArticulo;
use App\Observers\ArticuloObserver;
use App\Observers\ReservaEquipoArticuloObserver;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {

            if($notifiable->getModelGuard() == "empleado") {
                return config('app.frontend_url')."/empleados/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
            }
            
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Articulo::observe(ArticuloObserver::class);
        ReservaEquipoArticulo::observe(ReservaEquipoArticuloObserver::class);
    }
}

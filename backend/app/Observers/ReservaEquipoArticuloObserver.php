<?php

namespace App\Observers;

use App\Models\Articulo;
use App\Models\ReservaEquipoArticulo;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class ReservaEquipoArticuloObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the ReservaEquipoArticulo "created" event.
     *
     * @param  \App\Models\ReservaEquipoArticulo  $articulo
     * @return void
     */
    public function created(ReservaEquipoArticulo $reservaEquipoArticulo)
    {
        $articulo = $reservaEquipoArticulo->articulo()->first();

        if(empty($articulo->inventario()->first())) {
            $articulo->disponible = false;
            $articulo->saveQuietly();
        }
    }

    /**
     * Handle the Articulo "deleted" event.
     *
     * @param  \App\Models\ReservaEquipoArticulo  $reservaEquipoArticulo
     * @return void
     */
    public function deleted(ReservaEquipoArticulo $reservaEquipoArticulo)
    {
        $articulo = $reservaEquipoArticulo->articulo()->first();

        $articulo->disponible = true;
        $articulo->saveQuietly();
    }
    
    public function updated(ReservaEquipoArticulo $reservaEquipoArticulo)
    {
        $articulo = $reservaEquipoArticulo->articulo()->first();

        if(empty($articulo->inventario()->first())) {
            $articulo->disponible = $reservaEquipoArticulo->devuelto;
            $articulo->saveQuietly();
        }
    }
}

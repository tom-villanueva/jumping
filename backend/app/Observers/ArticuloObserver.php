<?php

namespace App\Observers;

use App\Models\Articulo;
use App\Models\TipoArticuloTalle;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class ArticuloObserver implements ShouldHandleEventsAfterCommit
{
        /**
     * Handle the Articulo "created" event.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return void
     */
    public function created(Articulo $articulo)
    {
        if($articulo->disponible) {
            $this->updateStock($articulo, 1);
        }
    }

    /**
     * Handle the Articulo "deleted" event.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return void
     */
    public function deleted(Articulo $articulo)
    {
        if($articulo->disponible) {
            $this->updateStock($articulo, -1);
        }
    }

    public function updated(Articulo $articulo)
    {
        if ($articulo->isDirty('disponible')) {
            // If "disponible" was false and is now true, add 1 to stock
            if (!$articulo->getOriginal('disponible') && $articulo->disponible) {
                $this->updateStock($articulo, 1);
            }
            // If "disponible" was true and is now false, subtract 1 from stock
            elseif ($articulo->getOriginal('disponible') && !$articulo->disponible) {
                $this->updateStock($articulo, -1);
            }
        }
    }

    /**
     * Update the stock in TipoArticuloTalle model.
     *
     * @param  \App\Models\Articulo  $articulo
     * @param  int  $amount
     * @return void
     */
    protected function updateStock(Articulo $articulo, int $amount)
    {
        $tipoArticuloTalle = TipoArticuloTalle::find($articulo->tipo_articulo_talle_id);

        if ($tipoArticuloTalle) {
            $tipoArticuloTalle->stock += $amount;
            $tipoArticuloTalle->save();
        }
    }
}

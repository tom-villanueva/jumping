<?php

namespace App\Observers;

use App\Models\Articulo;
use App\Models\Inventario;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\DB;

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
        // if($articulo->disponible) {
            $this->updateStock($articulo, 1);
        // }
    }

    /**
     * Handle the Articulo "deleted" event.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return void
     */
    public function deleted(Articulo $articulo)
    {
        // if($articulo->disponible) {
            $this->updateStock($articulo, -1);
        // }
    }

    
    public function updated(Articulo $articulo)
    {
        // Define the fields to monitor for changes
        $fieldsToCheck = ['tipo_articulo_id', 'talle_id', 'marca_id', 'modelo_id'];

        // Check if any of these fields have changed
        if ($articulo->wasChanged($fieldsToCheck)) {
            // Create a temporary Articulo model from the original values
            $originalArticulo = new Articulo($articulo->getOriginal());

            // Call updateStock with the old values (before the update)
            $this->updateStock($originalArticulo, -1);

            // Call updateStock with the new values (after the update)
            $this->updateStock($articulo, 1);
            // Call updateStock with the old values (before the update)
            // DB::afterCommit(function () use ($originalArticulo) {
            //     $this->updateStock($originalArticulo, -1);
            // });

            // // Call updateStock with the new values (after the update)
            // DB::afterCommit(function () use ($articulo) {
            //     $this->updateStock($articulo, 1);
            // });
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
        $inventario = Inventario::firstOrCreate([
            'tipo_articulo_id' => $articulo->tipo_articulo_id,
            'talle_id' => $articulo->talle_id,
            'marca_id' => $articulo->marca_id,
            'modelo_id' => $articulo->modelo_id,
        ], [
            'stock' => 0
        ]);

        $inventario->stock += $amount;
        $inventario->save();
    }
}

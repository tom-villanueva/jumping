<?php

namespace App\Models;

use App\Core\BaseModel;

class TipoArticuloTalle extends BaseModel
{
    protected $table = 'tipo_articulo_talle';
    
    /**
     * Relaciones
     */
    public function talle() {
        return $this->belongsTo(Talle::class, 'talle_id');
    }

    public function tipo_articulo() {
        return $this->belongsTo(TipoArticulo::class, 'tipo_articulo_id');
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
        ];
    }

    public function allowedSorts()
    {
        return [
        ];
    }

    public function allowedIncludes()
    {
        return [
            'talle',
            'tipo_articulo'
        ];
    }
}

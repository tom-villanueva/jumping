<?php

namespace App\Models;

use App\Core\BaseModel;

class Talle extends BaseModel
{
    protected $table = 'talle';

    protected $fillable = [
        'id',
        'descripcion'
    ];

    /**
     * Relaciones
     */
    public function tipo_articulo_talle() {
        return $this->belongsToMany(TipoArticulo::class, 'tipo_articulo_talle', 'talle_id', 'tipo_articulo_id');
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
            'tipo_articulo_talle'
        ];
    }
}

<?php

namespace App\Models;

use App\Core\BaseModel;

class TipoArticulo extends BaseModel
{
    protected $table = 'tipo_articulos';

    protected $fillable = [
        'id',
        'descripcion'
    ];

    /**
     * Relaciones
     */
    public function tipo_articulo_talle() {
        return $this->belongsToMany(Talle::class, 'tipo_articulo_talle', 'tipo_articulo_id', 'talle_id')
            ->withPivot('stock')
            ->as('talles');
    }

    public function equipo_tipo_articulo() {
        return $this->belongsToMany(Equipo::class, 'equipo_tipo_articulo', 'tipo_articulo_id', 'equipo_id')->as('equipos');
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
            'tipo_articulo_talle',
            'equipo_tipo_articulo'
        ];
    }
}

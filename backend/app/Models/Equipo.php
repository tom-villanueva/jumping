<?php

namespace App\Models;

use App\Core\BaseModel;

class Equipo extends BaseModel
{
    protected $table = 'equipo';

    protected $fillable = [
        'id',
        'descripcion',
        'precio',
        'disponible'
    ];

    /**
     * Relaciones
     */
    public function equipo_tipo_articulo() {
        return $this->belongsToMany(TipoArticulo::class, 'equipo_tipo_articulo', 'equipo_id', 'tipo_articulo_id');
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
            'equipo_tipo_articulo'
        ];
    }
}

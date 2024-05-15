<?php

namespace App\Models;

use App\Core\BaseModel;

class EquipoDescuento extends BaseModel
{
    protected $table = 'equipo_descuento';
    
    /**
     * Relaciones
     */
    public function equipo() {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    public function descuento() {
        return $this->belongsTo(Descuento::class, 'descuento_id');
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
            'equipo',
            'descuento'
        ];
    }
}
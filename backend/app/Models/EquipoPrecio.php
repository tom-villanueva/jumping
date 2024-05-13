<?php

namespace App\Models;

use App\Core\BaseModel;

class EquipoPrecio extends BaseModel
{
    protected $table = 'equipo_precio';

    protected $fillable = [
        'equipo_id',
        'precio',
    ];
    
    /**
     * Relaciones
     */
    public function equipo() 
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
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
            'equipo'
        ];
    }
}

<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipoDescuento extends BaseModel
{
    use SoftDeletes;
    protected $table = 'equipo_descuento';

    protected $fillable = [
        'equipo_id',
        'descuento_id',
        'fecha_desde',
        'fecha_hasta'
    ];
    
    /**
     * Relaciones
     */
    public function equipo() {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    public function descuento() {
        return $this->belongsTo(Descuento::class, 'descuento_id');
    }

    public function tieneReservasAsociadas()
    {
        return false;
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
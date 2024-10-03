<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservaEquipoDescuento extends BaseModel
{
    use HasFactory;

    protected $table = 'reserva_equipo_descuento';

    protected $fillable = [
        'reserva_equipo_id',
        'equipo_descuento_id',
        'descuento',
        'fecha_desde',
        'fecha_hasta',
        'dias'
    ];

    /**
     * Relaciones
     */
    public function reserva_equipo()
    {
        return $this->belongsTo(ReservaEquipo::class, 'reserva_equipo_id');
    }

    public function equipo_descuento()
    {
        return $this->belongsTo(EquipoDescuento::class, 'equipo_descuento_id');
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
            'reserva_equipo',
            'equipo_descuento'
        ];
    }
}
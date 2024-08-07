<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservaEquipoEquipoPrecio extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'reserva_equipo_equipo_precio';

    protected $fillable = [
        'reserva_equipo_id',
        'equipo_precio_id',
        'equipo_descuento_id'
    ];

    /**
     * Relaciones
     */
    public function reserva_equipo()
    {
        return $this->belongsTo(ReservaEquipo::class, 'reserva_equipo_id');
    }

    public function precio()
    {
        return $this->belongsTo(EquipoPrecio::class, 'equipo_precio_id');
    }

    public function descuento()
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
            'precio',
            'descuento',
        ];
    }
}

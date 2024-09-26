<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservaEquipoPrecio extends BaseModel
{
    use HasFactory;

    protected $table = 'reserva_equipo_precio';

    protected $fillable = [
        'reserva_equipo_id',
        'equipo_precio_id',
        'precio',
        'fecha_desde',
        'fecha_hasta'
    ];

    /**
     * Relaciones
     */
    public function reserva_equipo()
    {
        return $this->belongsTo(ReservaEquipo::class, 'reserva_equipo_id');
    }

    public function equipo_precio()
    {
        return $this->belongsTo(EquipoPrecio::class, 'equipo_precio_id');
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
            'equipo_precio'
        ];
    }
}

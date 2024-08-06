<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservaEquipoArticulo extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'reserva_equipo_articulo';

    protected $fillable = [
        'articulo_id',
        'reserva_equipo_id',
        'devuelto'
    ];

    /**
     * Relaciones
     */
    public function reserva_equipo()
    {
        return $this->belongsTo(ReservaEquipo::class, 'reserva_equipo_id');
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'articulo_id');
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
            'articulo'
        ];
    }
}

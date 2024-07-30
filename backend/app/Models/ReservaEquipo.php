<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservaEquipo extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'reserva_equipo';

    protected $fillable = [
        'altura',
        'peso',
        'num_calzado',
        'nombre',
        'apellido',
        'reserva_id',
        'equipo_id'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

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
            'reserva_id',
            'equipo_id'
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
        ];
    }
}

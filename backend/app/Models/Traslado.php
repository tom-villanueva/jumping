<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

class Traslado extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'traslados';

    protected $fillable = [
        'direccion',
        'fecha_desde',
        'fecha_hasta',
        'reserva_id',
        'precio',
        'traslado_precio_id'
    ];

    /**
     * Relaciones
     */
    public function reserva() 
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    public function precio() 
    {
        return $this->belongsTo(TrasladoPrecio::class, 'traslado_precio_id');
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            AllowedFilter::exact('reserva_id')
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

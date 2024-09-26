<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

class ReservaEstado extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'reserva_estado';

    protected $fillable = [
        'reserva_id',
        'estado_id',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            AllowedFilter::exact('reserva_id'),
            AllowedFilter::exact('estado_id')
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
            'reserva',
            'estado'
        ];
    }
}

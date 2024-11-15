<?php

namespace App\Models;

use App\Core\BaseModel;
use Carbon\Carbon;
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

    // fecha desde
    public function scopeFechaDesdeBefore($query, $date)
    {
        return $query->where('fecha_desde', '<=', Carbon::parse($date));
    }

    public function scopeFechaDesdeAfter($query, $date)
    {
        return $query->where('fecha_desde', '>=', Carbon::parse($date));
    }

    public function scopeFechaDesdeBetween($query, $date1, $date2)
    {
        return $query->whereBetween('fecha_desde', [$date1, $date2]);
    }

    // fecha hasta
    public function scopeFechaHastaBefore($query, $date)
    {
        return $query->where('fecha_hasta', '<=', Carbon::parse($date));
    }

    public function scopeFechaHastaAfter($query, $date)
    {
        return $query->where('fecha_hasta', '>=', Carbon::parse($date));
    }

    public function scopeFechaHastaBetween($query, $date1, $date2)
    {
        return $query->whereBetween('fecha_hasta', [$date1, $date2]);
    }

    // Entre fecha desde y fecha hasta
    public function scopeFechasBetween($query, $date1, $date2)
    {
        return $query
            ->whereDate('fecha_desde', '>=', $date1)
            ->whereDate('fecha_hasta', '<=', $date2);
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            'direccion',
            AllowedFilter::exact('reserva_id'),
            AllowedFilter::scope('fecha_desde_before'),
            AllowedFilter::scope('fecha_desde_after'),
            AllowedFilter::scope('fecha_desde_between'),
            AllowedFilter::scope('fecha_hasta_before'),
            AllowedFilter::scope('fecha_hasta_after'),
            AllowedFilter::scope('fecha_hasta_between'),
            AllowedFilter::scope('fechas_between'),
        ];
    }

    public function allowedSorts()
    {
        return [
            'fecha_desde',
            'fecha_hasta'
        ];
    }

    public function allowedIncludes()
    {
        return [
            'reserva',
            'precio'
        ];
    }
}

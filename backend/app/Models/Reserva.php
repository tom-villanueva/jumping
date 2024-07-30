<?php

namespace App\Models;

use App\Core\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

class Reserva extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'fecha_prueba',
        'fecha_desde',
        'fecha_hasta',
        'comentario',
        'estado_id',
        'user_id',
        'nombre',
        'apellido',
        'email',
        'telefono'
    ];

    /**
     * Relaciones
     */
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function traslados() 
    {
        return $this->hasMany(Traslado::class, 'reserva_id');
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'reserva_equipo', 'reserva_id', 'equipo_id')
            ->withPivot(['id', 'altura', 'peso', 'nombre', 'apellido', 'num_calzado'])
            ->wherePivotNull('deleted_at')
            ->withTimestamps();
    }

    /**
     * Scopes de fechas
     */

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
            AllowedFilter::exact('estado_id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::beginsWithStrict('apellido'),
            'email',
            'telefono',
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
        ];
    }

    public function allowedIncludes()
    {
        return [
            'user',
            'estado',
            'traslados',
            'equipos'
        ];
    }
}

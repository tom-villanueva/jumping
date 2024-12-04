<?php

namespace App\Models;

use App\Core\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

class Voucher extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'vouchers';

    protected $fillable = [
        'descripcion',
        'fecha_expiracion',
        'dias',
        'reserva_id',
        'cliente_id'
    ];

    /**
     * Relaciones
     */
    public function reserva() 
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    public function cliente() 
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function equipo_voucher()
    {
        return $this->hasMany(EquipoVoucher::class, 'voucher_id');
    }

    public function traslado_precio_voucher()
    {
        return $this->hasMany(TrasladoPrecioVoucher::class, 'voucher_id');
    }

    /**
     * Scopes de fechas
     */

    // fecha desde
    public function scopeFechaExpiracionBefore($query, $date)
    {
        return $query->where('fecha_expiracion', '<=', Carbon::parse($date));
    }

    public function scopeFechaExpiracionAfter($query, $date)
    {
        return $query->where('fecha_expiracion', '>=', Carbon::parse($date));
    }

    public function scopeFechaExpiracionBetween($query, $date1, $date2)
    {
        return $query->whereBetween('fecha_expiracion', [$date1, $date2]);
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            AllowedFilter::exact('reserva_id'),
            AllowedFilter::exact('cliente_id'),
            AllowedFilter::scope('fecha_expiracion_before'),
            AllowedFilter::scope('fecha_expiracion_after'),
            AllowedFilter::scope('fecha_expiracion_between'),
            'dias',
            'descripcion',
            AllowedFilter::beginsWithStrict('cliente.apellido'),
            AllowedFilter::beginsWithStrict('cliente.email'),
        ];
    }

    public function allowedSorts()
    {
        return [
            'fecha_expiracion'
        ];
    }

    public function allowedIncludes()
    {
        return [
            'reserva',
            'cliente',
            'equipo_voucher',
            'equipo_voucher.equipo',
            'traslado_precio_voucher'
        ];
    }
}

<?php

namespace App\Models;

use App\Core\BaseModel;
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
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            AllowedFilter::exact('reserva_id'),
            AllowedFilter::exact('cliente_id')
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
            'cliente',
            'equipo_voucher',
            'traslado_precio_voucher'
        ];
    }
}

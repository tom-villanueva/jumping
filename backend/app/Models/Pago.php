<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'total',
        'status',
        'reserva_id',
        'numero_comprobante',
        'metodo_pago_id',
        'moneda_id'
    ];

    /**
     * Relaciones
     */
    public function metodo_pago() 
    {
        return $this->belongsTo(MetodoPago::class, 'metodo_pago_id');
    }

    public function moneda() 
    {
        return $this->belongsTo(Moneda::class, 'moneda_id');
    }

    public function reserva() 
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
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
            'metodo_pago',
            'moneda'
        ];
    }
}

<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

class TrasladoPrecioVoucher extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'traslado_precio_voucher';

    protected $fillable = [
        'traslado_precio_id',
        'voucher_id',
    ];

    /**
     * Relaciones
     */
    public function traslado_precio() 
    {
        return $this->belongsTo(TrasladoPrecio::class, 'traslado_precio_id');
    }

    public function voucher() 
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            AllowedFilter::exact('traslado_precio_id'),
            AllowedFilter::exact('voucher_id')
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
            'traslado_precio',
            'voucher'
        ];
    }
}

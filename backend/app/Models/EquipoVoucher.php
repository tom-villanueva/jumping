<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\QueryBuilder\AllowedFilter;

class EquipoVoucher extends BaseModel
{
    use HasFactory;

    protected $table = 'equipo_voucher';

    protected $fillable = [
        'equipo_id',
        'voucher_id',
        'precio'
    ];

    /**
     * Relaciones
     */
    public function equipo() 
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
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
            AllowedFilter::exact('equipo_id'),
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
            'equipo',
            'voucher'
        ];
    }
}

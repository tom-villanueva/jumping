<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetodoPago extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'metodo_pago';

    protected $fillable = [
        'descripcion',
        'descuento_id' // nullable
    ];

    public function descuento() {
        return $this->belongsTo(Descuento::class, 'descuento_id');
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            'descripcion'
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
            'descuento'
        ];
    }
}

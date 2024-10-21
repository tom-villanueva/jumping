<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoPersona extends BaseModel
{
    use HasFactory;

    protected $table = 'tipo_persona';

    protected $fillable = [
        'descripcion',
        'descuento_id'
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

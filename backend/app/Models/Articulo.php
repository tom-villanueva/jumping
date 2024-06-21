<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articulo extends BaseModel
{
    use SoftDeletes, HasFactory;
    
    protected $table = 'articulo';

    protected $fillable = [
        'id',
        'descripcion',
        'codigo',
        'observacion',
        'tipo_articulo_talle_id'
    ];

    /**
     * Relaciones
     */
    public function tipo_articulo_talle() {
        return $this->belongsTo(TipoArticuloTalle::class, 'tipo_articulo_talle_id');
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
            'tipo_articulo_talle',
            'tipo_articulo_talle.talle',
            'tipo_articulo_talle.tipo_articulo'
        ];
    }
}

<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoArticuloTalle extends BaseModel
{
    use HasFactory;
    
    protected $table = 'tipo_articulo_talle';

    protected $fillable = [
        'talle_id',
        'tipo_articulo_id',
        'stock'
    ];
    
    /**
     * Relaciones
     */
    public function talle() {
        return $this->belongsTo(Talle::class, 'talle_id');
    }

    public function tipo_articulo() {
        return $this->belongsTo(TipoArticulo::class, 'tipo_articulo_id');
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
            'talle',
            'tipo_articulo'
        ];
    }
}

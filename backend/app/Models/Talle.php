<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Talle extends BaseModel
{
    use SoftDeletes, HasFactory;
    protected $table = 'talle';

    protected $fillable = [
        'id',
        'descripcion'
    ];

    /**
     * Relaciones
     */
    public function tipos() 
    {
        return $this->belongsToMany(TipoArticulo::class, 'tipo_articulo_talle', 'talle_id', 'tipo_articulo_id');
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
            'tipos'
        ];
    }
}

<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoArticulo extends BaseModel
{
    use SoftDeletes, HasFactory;
    protected $table = 'tipo_articulos';

    protected $fillable = [
        'id',
        'descripcion'
    ];

    /**
     * Relaciones
     */
    public function equipo_tipo_articulo()
    {
        return $this->belongsToMany(Equipo::class, 'equipo_tipo_articulo', 'tipo_articulo_id', 'equipo_id');
    }

    public function talles()
    {
        return $this->belongsToMany(Talle::class, 'tipo_articulo_talle', 'tipo_articulo_id', 'talle_id');
    }

    public function marcas()
    {
        return $this->belongsToMany(Marca::class, 'tipo_articulo_marca', 'tipo_articulo_id', 'marca_id');
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
        return [];
    }

    public function allowedIncludes()
    {
        return [
            'equipo_tipo_articulo',
            'talles',
            'marcas'
        ];
    }
}

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
            'equipo_tipo_articulo'
        ];
    }
}

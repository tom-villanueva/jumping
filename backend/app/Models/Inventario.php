<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

class Inventario extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'inventario';

    protected $fillable = [
        'tipo_articulo_id',
        'talle_id',
        'marca_id',
        'modelo_id',
        'stock'
    ];

    /**
     * Relaciones
     */
    public function tipo_articulo() 
    {
        return $this->belongsTo(TipoArticulo::class, 'tipo_articulo_id');
    }

    public function talle() 
    {
        return $this->belongsTo(Talle::class, 'talle_id');
    }

    public function marca() 
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function modelo() 
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            AllowedFilter::exact('talle.id'),
            AllowedFilter::exact('tipo_articulo.id'),
            AllowedFilter::exact('marca.id'),
            AllowedFilter::exact('modelo.id'),
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
            'tipo_articulo',
            'modelo',
            'marca'
        ];
    }
}

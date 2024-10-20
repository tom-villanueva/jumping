<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

// #[ObservedBy([ArticuloObserver::class])] esto no anda
class Articulo extends BaseModel
{
    use SoftDeletes, HasFactory;
    
    protected $table = 'articulo';

    protected $fillable = [
        'id',
        'descripcion',
        'codigo',
        'observacion',
        'tipo_articulo_id',
        'talle_id',
        'marca_id',
        'modelo_id',
        'nro_serie',
        'disponible'
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

    public function inventario()
    {
        return $this->hasOne(Inventario::class, 'articulo_id');
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            AllowedFilter::beginsWithStrict('nro_serie'),
            AllowedFilter::beginsWithStrict('codigo'),
            AllowedFilter::beginsWithStrict('descripcion'),
            AllowedFilter::exact('tipo_articulo_id'),
            AllowedFilter::exact('talle_id'),
            AllowedFilter::exact('marca_id'),
            AllowedFilter::exact('modelo_id'),
            AllowedFilter::exact('disponible')
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
            'tipo_articulo',
            'talle',
            'marca',
            'modelo',
            'inventario'
        ];
    }
}

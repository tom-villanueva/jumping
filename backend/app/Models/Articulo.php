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
        'tipo_articulo_talle_id',
        'nro_serie',
        'disponible'
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
            AllowedFilter::beginsWithStrict('nro_serie'),
            AllowedFilter::beginsWithStrict('codigo'),
            AllowedFilter::beginsWithStrict('descripcion'),
            AllowedFilter::exact('tipo_articulo_talle.talle.id'),
            AllowedFilter::exact('tipo_articulo_talle.tipo_articulo.id'),
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
            'tipo_articulo_talle',
            'tipo_articulo_talle.talle',
            'tipo_articulo_talle.tipo_articulo'
        ];
    }
}

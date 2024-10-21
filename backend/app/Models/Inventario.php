<?php

namespace App\Models;

use App\Core\AllowedSorts\TalleDescripcionSort;
use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class Inventario extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'inventario';

    protected $appends = [
        'stock_alquilado'
    ];

    protected $fillable = [
        'tipo_articulo_id',
        'talle_id',
        'marca_id',
        'modelo_id',
        'articulo_id', // nullable
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

    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'articulo_id');
    }

    public function getStockAlquiladoAttribute()
    {
        $stockAlquilado = 0;

        if ($this->articulo_id == null) {
            $stockAlquilado = ReservaEquipoArticulo::with('articulo')
                ->where('devuelto', false)
                ->whereHas('articulo', function ($query) {
                    $query->where('tipo_articulo_id', $this->tipo_articulo_id)
                        ->where('talle_id', $this->talle_id)
                        ->where('marca_id', $this->marca_id)
                        ->where('modelo_id', $this->modelo_id);
                })
                ->count();
        } else {
            $stockAlquilado = ReservaEquipoArticulo::where('devuelto', false)
                ->where('articulo_id', $this->articulo_id)
                ->count();
        }

        return $stockAlquilado;
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            AllowedFilter::exact('talle_id'),
            AllowedFilter::exact('tipo_articulo_id'),
            AllowedFilter::exact('marca_id'),
            AllowedFilter::exact('modelo_id'),
            AllowedFilter::exact('articulo_id'),
        ];
    }

    public function allowedSorts()
    {
        return [
            AllowedSort::custom('talle_descripcion', new TalleDescripcionSort()),
            'stock',
        ];
    }

    public function allowedIncludes()
    {
        return [
            'talle',
            'tipo_articulo',
            'modelo',
            'marca',
            'articulo'
        ];
    }
}

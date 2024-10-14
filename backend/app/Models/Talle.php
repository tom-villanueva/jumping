<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Builder;

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
            AllowedFilter::callback('tipo_articulo_id', function (Builder $query, $value) {
                $query->whereHas('tipos', function (Builder $query) use ($value) {
                    $query->whereIn('tipo_articulo_id', (array)$value);
                });
            }),
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
            'tipos'
        ];
    }
}

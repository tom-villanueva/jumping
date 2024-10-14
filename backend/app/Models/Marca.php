<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

class Marca extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'marca';

    protected $fillable = [
        'descripcion'
    ];

    public function tipos()
    {
        return $this->belongsToMany(TipoArticulo::class, 'tipo_articulo_marca', 'marca_id', 'tipo_articulo_id');
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

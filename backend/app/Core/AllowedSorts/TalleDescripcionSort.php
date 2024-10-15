<?php

namespace App\Core\AllowedSorts;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class TalleDescripcionSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        // Join the `talles` table and sort by `description` field
        $query->join('talle', 'inventario.talle_id', '=', 'talle.id')
              ->orderBy('talle.descripcion', $descending ? 'desc' : 'asc');
    }
}

<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

class Modelo extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'modelo';

    protected $fillable = [
        'descripcion',
        'marca_id'
    ];

    /**
     * Relaciones
     */
    public function marca() {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            'descripcion',
            AllowedFilter::exact('marca_id')
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
            'marca'
        ];
    }
}

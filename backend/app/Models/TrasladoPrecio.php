<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrasladoPrecio extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'traslado_precio';

    protected $fillable = [
        'precio',
        'fecha_desde',
        'fecha_hasta'
    ];

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
        ];
    }
}

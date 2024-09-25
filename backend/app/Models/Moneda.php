<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Moneda extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'monedas';

    protected $fillable = [
        'descripcion',
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
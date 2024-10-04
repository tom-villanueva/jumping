<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Descuento extends BaseModel
{
    use SoftDeletes, HasFactory;
    
    protected $table = 'descuentos';

    protected $fillable = [
        'valor',
        'descripcion',
        'tipo_descuento'
    ];

    /**
     * Relaciones
     */
    public function equipo_descuento() 
    {
        return $this->belongsToMany(Equipo::class, 'equipo_descuento', 'descuento_id', 'equipo_id')
            ->withPivot(['fecha_desde', 'fecha_hasta', 'deleted_at'])
            ->wherePivotNull('deleted_at')
            ->withTimestamps();
    }

    public function equipo_descuento_trashed()
    {
        return $this->belongsToMany(Descuento::class, 'equipo_descuento', 'descuento_id', 'equipo_id')
            ->withPivot(['fecha_desde', 'fecha_hasta', 'deleted_at'])
            ->withTimestamps();
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
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
            'equipo_descuento'
        ];
    }
}

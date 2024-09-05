<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipoPrecio extends BaseModel
{
    use SoftDeletes, HasFactory;
    
    protected $table = 'equipo_precio';

    protected $fillable = [
        'equipo_id',
        'precio',
        'fecha_desde',
        'fecha_hasta'
    ];
    
    /**
     * Relaciones
     */
    public function equipo() 
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

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
            'equipo'
        ];
    }
}

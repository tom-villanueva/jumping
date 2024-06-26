<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipoPrecio extends BaseModel
{
    use HasFactory;
    
    protected $table = 'equipo_precio';

    protected $fillable = [
        'equipo_id',
        'precio',
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

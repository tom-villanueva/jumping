<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

class ReservaEquipo extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'reserva_equipo';

    protected $fillable = [
        'altura',
        'peso',
        'num_calzado',
        'nombre',
        'apellido',
        'reserva_id',
        'equipo_id',
        'equipo_precio_id',
        'equipo_descuento_id'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    public function articulos()
    {
        return $this->hasMany(ReservaEquipoArticulo::class, 'reserva_equipo_id');
    }

    public function precio()
    {
        return $this->belongsTo(EquipoPrecio::class, 'equipo_precio_id');
    }

    public function descuento()
    {
        return $this->belongsTo(EquipoDescuento::class, 'equipo_descuento_id');
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            AllowedFilter::exact('reserva_id'),
            AllowedFilter::exact('equipo_id')
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
            'reserva',
            'equipo',
            'articulos',
            'precio',
            'descuento'
        ];
    }
}

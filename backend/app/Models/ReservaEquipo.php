<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\QueryBuilder\AllowedFilter;

class ReservaEquipo extends BaseModel
{
    use HasFactory;

    protected $table = 'reserva_equipo';

    protected $fillable = [
        'altura',
        'peso',
        'num_calzado',
        'nombre',
        'apellido',
        'reserva_id',
        'equipo_id',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id')->withTrashed();
    }

    public function articulos()
    {
        return $this->hasMany(ReservaEquipoArticulo::class, 'reserva_equipo_id');
    }

    public function precios()
    {
        return $this->hasMany(ReservaEquipoPrecio::class, 'reserva_equipo_id');
    }

    public function descuentos()
    {
        return $this->hasMany(ReservaEquipoDescuento::class, 'reserva_equipo_id');
    }

    /**
     * Funciones
     */
    public function storePreciosAndDescuentos($fechaDesde, $fechaHasta)
    {
        $precios = $this->equipo->precios_vigentes_en_rango($fechaDesde, $fechaHasta)
                ->get();

        foreach ($precios as $precio) {
            // Crear reserva_equipo_precio
            ReservaEquipoPrecio::create([
                'reserva_equipo_id' => $this->id,
                'equipo_precio_id' => $precio->id,
                'precio' => $precio->precio,
                'fecha_desde' => $precio->fecha_desde,
                'fecha_hasta' => $precio->fecha_hasta ?? $fechaHasta,
            ]);
        }
            

        $descuento = $this->equipo->getDescuentoByDays($fechaDesde, $fechaHasta);

        if(!empty($descuento)) {
            ReservaEquipoDescuento::create([
                'reserva_equipo_id' => $this->id,
                'equipo_descuento_id' => $descuento->id,
                'descuento' => $descuento->descuento->valor,
                'dias' => $descuento->dias
            ]);
        }
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
            'precios',
            'descuentos',
            'equipo.equipo_tipo_articulo'
        ];
    }
}

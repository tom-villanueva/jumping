<?php

namespace App\Models;

use App\Core\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Period\Period;

class Equipo extends BaseModel implements HasMedia
{
    use SoftDeletes, HasFactory, InteractsWithMedia;

    protected $table = 'equipo';

    protected $appends = [
        'thumb_url',
        'precio_vigente'
    ];

    protected $fillable = [
        'id',
        'descripcion',
        'disponible',
        'tipo_equipo_id'
    ];

    /**
     * Relaciones
     */
    public function equipo_tipo_articulo() 
    {
        return $this->belongsToMany(TipoArticulo::class, 'equipo_tipo_articulo', 'equipo_id', 'tipo_articulo_id');
    }

    public function tipo_equipo() {
        return $this->belongsTo(TipoEquipo::class, 'tipo_equipo_id');
    }

    // precios
    public function equipo_precio() 
    {
        return $this->hasMany(EquipoPrecio::class, 'equipo_id');
    }
    
    public function precios_vigentes() 
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->equipo_precio()
             ->where(function ($query) use ($today) {
                $query->whereDate('fecha_hasta', '>=', $today)
                    ->orWhereNull('fecha_hasta');
            })
            ->orderBy('fecha_hasta', 'asc');
    }

    public function precios_vigentes_en_rango($startDate, $endDate)
    {
        return $this->equipo_precio()
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($query) use ($startDate, $endDate) {
                    $query->whereDate('fecha_desde', '<=', $endDate)
                        ->whereDate('fecha_hasta', '>=', $startDate);
                })
                ->orWhere(function ($query) use ($startDate, $endDate) {
                    $query->whereDate('fecha_desde', '<=', $endDate)
                        ->whereNull('fecha_hasta');
                });
            })
            ->orderBy('fecha_hasta', 'asc');
    }

    // descuentos
    public function equipo_descuento() 
    {
        return $this->belongsToMany(Descuento::class, 'equipo_descuento', 'equipo_id', 'descuento_id')
            ->withPivot(['id', 'fecha_desde', 'fecha_hasta', 'dias', 'deleted_at'])
            ->wherePivotNull('deleted_at')
            ->withTimestamps();
    }

    public function equipo_descuento_trashed()
    {
        return $this->belongsToMany(Descuento::class, 'equipo_descuento', 'equipo_id', 'descuento_id')
            ->withPivot(['id', 'fecha_desde', 'fecha_hasta', 'deleted_at'])
            ->withTimestamps();
    }

    public function descuentos_vigentes()
    {
        // $today = Carbon::now()->format('Y-m-d');
        return $this->equipo_descuento()
            // ->whereDate('fecha_hasta', '>=', $today)
            ->orderBy("dias", 'asc');
    }

    public function getDescuentoByDays($fechaDesde, $fechaHasta)
    {
        // Create a period for the reservation dates
        $reservaPeriod = Period::make($fechaDesde, $fechaHasta);
        $dias = $reservaPeriod->length();

        // Get all EquipoDescuentos for the given Equipo
        $descuentos = EquipoDescuento::where('equipo_id', $this->id)->orderBy('dias')->get();

        // Check if there are any descuentos for the given equipo
        if ($descuentos->isEmpty()) {
            return null;
        }

        // Look for an exact match of 'dias'
        $exactMatch = $descuentos->firstWhere('dias', $dias);
        if ($exactMatch) {
            return $exactMatch;
        }

        // Find the lowest and highest 'dias' values
        $lowestDescuento = $descuentos->first();
        $highestDescuento = $descuentos->last();

        // If $dias is lower than the lowest 'dias', return null
        if ($dias < $lowestDescuento->dias) {
            return null;
        }

        // If $dias is greater than the highest 'dias', return the highest EquipoDescuento
        if ($dias > $highestDescuento->dias) {
            return $highestDescuento;
        }

        // If no match is found, return null (this case should rarely happen if ordered correctly)
        return null;
    }

    // public function descuentos_vigentes_en_rango($startDate, $endDate)
    // {
    //     return $this->equipo_descuento()
    //         ->where(function ($query) use ($startDate, $endDate) {
    //             $query->where(function ($query) use ($startDate, $endDate) {
    //                 $query->whereDate('fecha_desde', '<=', $endDate)
    //                     ->whereDate('fecha_hasta', '>=', $startDate);
    //             });
    //         })
    //         ->orderBy('fecha_hasta', 'asc');
    // }

    // reservas 
    public function reservas()
    {
        return $this->belongsToMany(Reserva::class, 'reserva_equipo', 'equipo_id', 'reserva_id')
            ->withPivot(['id', 'altura', 'peso', 'nombre', 'apellido', 'num_calzado'])
            ->wherePivotNull('deleted_at')
            ->withTimestamps();
    }

    /**
     * Accessors
     */
    protected function getThumbUrlAttribute()
    {
        $media = $this->getFirstMedia('thumbnail');

        if(isset($media)) {
            return $media->getUrl('thumb');
        }

        return '';
    }

    public function getPrecioVigenteAttribute()
    {
        return $this->equipo_precio()
            ->whereNull('fecha_hasta')
            ->first();
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
            'equipo_tipo_articulo',
            'equipo_precio',
            'precios_vigentes', 
            'equipo_descuento',
            'descuentos_vigentes',
            'reservas',
            'tipo_equipo'
        ];
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('thumbnail')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(360)
              ->height(360)
              ->nonQueued();
    }
}

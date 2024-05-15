<?php

namespace App\Models;

use App\Core\BaseModel;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends BaseModel implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    protected $table = 'equipo';

    protected $appends = [
        'thumb_url'
    ];

    protected $fillable = [
        'id',
        'descripcion',
        'disponible'
    ];

    /**
     * Relaciones
     */
    public function equipo_tipo_articulo() 
    {
        return $this->belongsToMany(TipoArticulo::class, 'equipo_tipo_articulo', 'equipo_id', 'tipo_articulo_id');
    }

    public function equipo_precio() 
    {
        return $this->hasMany(EquipoPrecio::class, 'equipo_id');
    }
    
    public function precios() 
    {
        return $this->equipo_precio()->orderBy('created_at', 'desc');
    }

    public function precio_vigente()
    {
        return $this->equipo_precio()
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function equipo_descuento() 
    {
        return $this->belongsToMany(Descuento::class, 'equipo_descuento', 'equipo_id', 'descuento_id')
            ->withPivot(['fecha_desde', 'fecha_hasta', 'deleted_at'])
            ->whereNull('deleted_at')
            ->withTimestamps();
    }

    public function equipo_descuento_trashed()
    {
        return $this->belongsToMany(Descuento::class, 'equipo_descuento', 'equipo_id', 'descuento_id')
            ->withPivot(['fecha_desde', 'fecha_hasta', 'deleted_at'])
            ->withTimestamps();
    }

    public function descuentos_vigentes()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->equipo_descuento()
            ->whereDate('fecha_hasta', '<=', $today)
            ->orderBy("fecha_hasta", 'desc');
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
            'equipo_tipo_articulo',
            'equipo_precio',
            'precios',
            'precio_vigente',
            'equipo_descuento',
            'descuentos_vigentes'
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

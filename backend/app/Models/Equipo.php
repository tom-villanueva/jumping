<?php

namespace App\Models;

use App\Core\BaseModel;
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

    public function precios() 
    {
        return $this->equipo_precio()->orderBy('created_at', 'desc');
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
            'precios'
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

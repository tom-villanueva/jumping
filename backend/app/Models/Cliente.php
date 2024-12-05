<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

class Cliente extends BaseModel
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'fecha_nacimiento',
        'tipo_persona_id',
        'user_id'
    ];

    public function delete()
    {
        $this->reservas()->each(function ($reserva) {
            $reserva->delete();
        });

        parent::delete();
    }

    /**
     * Relaciones
     */
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'cliente_id');
    }

    public function tipo_persona() 
    {
        return $this->belongsTo(TipoPersona::class, 'tipo_persona_id');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            AllowedFilter::exact('tipo_persona_id'),
            AllowedFilter::exact('user_id'),
            'nombre',
            'apellido',
            'telefono',
            'email',
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
            'reservas',
            'tipo_persona'
        ];
    }
}

<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'fecha_prueba',
        'fecha_desde',
        'fecha_hasta',
        'comentario',
        'estado_id',
        'user_id',
        'nombre',
        'apellido',
        'email',
        'telefono'
    ];

    /**
     * Relaciones
     */
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            'estado_id'
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

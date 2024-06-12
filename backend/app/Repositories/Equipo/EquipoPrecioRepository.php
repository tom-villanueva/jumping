<?php

namespace App\Repositories\Equipo;

use App\Core\BaseRepository;
use App\Models\EquipoPrecio;
use Illuminate\Http\Request;

class EquipoPrecioRepository extends BaseRepository
{
    public function __construct(EquipoPrecio $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}
<?php

namespace App\Repositories\ReservaEquipoEquipoPrecio;

use App\Core\BaseRepository;
use App\Models\ReservaEquipoEquipoPrecio;
use Illuminate\Http\Request;

class ReservaEquipoEquipoPrecioRepository extends BaseRepository
{
    public function __construct(ReservaEquipoEquipoPrecio $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

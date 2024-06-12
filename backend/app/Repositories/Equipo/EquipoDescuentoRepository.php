<?php

namespace App\Repositories\Equipo;

use App\Core\BaseRepository;
use App\Models\EquipoDescuento;
use Illuminate\Http\Request;

class EquipoDescuentoRepository extends BaseRepository
{
    public function __construct(EquipoDescuento $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}
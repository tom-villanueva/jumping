<?php

namespace App\Repositories\Equipo;

use App\Core\BaseRepository;
use App\Models\EquipoDescuento;

class EquipoDescuentoRepository extends BaseRepository
{
    protected $model;

    public function __construct(EquipoDescuento $model)
    {
        $this->model = $model;
    }
}
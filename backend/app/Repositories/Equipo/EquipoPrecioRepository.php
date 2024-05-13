<?php

namespace App\Repositories\Equipo;

use App\Core\BaseRepository;
use App\Models\EquipoPrecio;

class EquipoPrecioRepository extends BaseRepository
{
    protected $model;

    public function __construct(EquipoPrecio $model)
    {
        $this->model = $model;
    }
}
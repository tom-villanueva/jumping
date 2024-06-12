<?php

namespace App\Repositories\Equipo;

use App\Core\BaseRepository;
use App\Models\EquipoPrecio;
use Illuminate\Database\Eloquent\Model;

class EquipoPrecioRepository extends BaseRepository
{
    protected Model $model;

    public function __construct(EquipoPrecio $model)
    {
        $this->model = $model;
    }
}
<?php

namespace App\Repositories\Equipo;

use App\Core\BaseRepository;
use App\Models\EquipoDescuento;
use Illuminate\Database\Eloquent\Model;

class EquipoDescuentoRepository extends BaseRepository
{
    protected Model $model;

    public function __construct(EquipoDescuento $model)
    {
        $this->model = $model;
    }
}
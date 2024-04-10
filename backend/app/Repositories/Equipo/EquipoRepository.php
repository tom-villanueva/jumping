<?php

namespace App\Repositories\Equipo;

use App\Core\BaseRepository;
use App\Models\Equipo;

class EquipoRepository extends BaseRepository
{
    protected $model;

    public function __construct(Equipo $model)
    {
        $this->model = $model;
    }
}

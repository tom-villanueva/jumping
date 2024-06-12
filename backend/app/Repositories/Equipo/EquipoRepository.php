<?php

namespace App\Repositories\Equipo;

use App\Core\BaseRepository;
use App\Models\Equipo;
use Illuminate\Database\Eloquent\Model;

class EquipoRepository extends BaseRepository
{
    protected Model $model;

    public function __construct(Equipo $model)
    {
        $this->model = $model;
    }
}

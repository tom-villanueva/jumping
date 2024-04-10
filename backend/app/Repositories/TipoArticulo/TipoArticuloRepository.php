<?php

namespace App\Repositories\TipoArticulo;

use App\Core\BaseRepository;
use App\Models\TipoArticulo;

class TipoArticuloRepository extends BaseRepository
{
    protected $model;

    public function __construct(TipoArticulo $model)
    {
        $this->model = $model;
    }
}

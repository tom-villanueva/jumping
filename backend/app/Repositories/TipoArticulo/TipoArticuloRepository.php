<?php

namespace App\Repositories\TipoArticulo;

use App\Core\BaseRepository;
use App\Models\TipoArticulo;
use Illuminate\Database\Eloquent\Model;

class TipoArticuloRepository extends BaseRepository
{
    protected Model $model;

    public function __construct(TipoArticulo $model)
    {
        $this->model = $model;
    }
}

<?php

namespace App\Repositories\Articulo;

use App\Core\BaseRepository;
use App\Models\Articulo;
use Illuminate\Database\Eloquent\Model;

class ArticuloRepository extends BaseRepository
{
    protected Model $model;

    public function __construct(Articulo $model)
    {
        $this->model = $model;
    }
}

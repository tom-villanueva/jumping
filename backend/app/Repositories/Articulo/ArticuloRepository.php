<?php

namespace App\Repositories\Articulo;

use App\Core\BaseRepository;
use App\Models\Articulo;

class ArticuloRepository extends BaseRepository
{
    protected $model;

    public function __construct(Articulo $model)
    {
        $this->model = $model;
    }
}

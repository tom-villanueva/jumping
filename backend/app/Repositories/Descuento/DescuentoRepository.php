<?php

namespace App\Repositories\Descuento;

use App\Core\BaseRepository;
use App\Models\Descuento;

class DescuentoRepository extends BaseRepository
{
    protected $model;

    public function __construct(Descuento $model)
    {
        $this->model = $model;
    }
}

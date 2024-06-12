<?php

namespace App\Repositories\Descuento;

use App\Core\BaseRepository;
use App\Models\Descuento;
use Illuminate\Database\Eloquent\Model;

class DescuentoRepository extends BaseRepository
{
    protected Model $model;

    public function __construct(Descuento $model)
    {
        $this->model = $model;
    }
}

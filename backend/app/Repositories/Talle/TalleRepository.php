<?php

namespace App\Repositories\Talle;

use App\Core\BaseRepository;
use App\Models\Talle;

class TalleRepository extends BaseRepository
{
    protected $model;

    public function __construct(Talle $model)
    {
        $this->model = $model;
    }
}

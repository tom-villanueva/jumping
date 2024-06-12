<?php

namespace App\Repositories\Talle;

use App\Core\BaseRepository;
use App\Models\Talle;
use Illuminate\Database\Eloquent\Model;

class TalleRepository extends BaseRepository
{
    protected Model $model;

    public function __construct(Talle $model)
    {
        $this->model = $model;
    }
}

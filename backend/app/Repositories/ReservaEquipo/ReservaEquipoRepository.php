<?php

namespace App\Repositories\ReservaEquipo;

use App\Core\BaseRepository;
use App\Models\ReservaEquipo;
use Illuminate\Http\Request;

class ReservaEquipoRepository extends BaseRepository
{
    public function __construct(ReservaEquipo $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

<?php

namespace App\Repositories\ReservaEquipoArticulo;

use App\Core\BaseRepository;
use App\Models\ReservaEquipoArticulo;
use Illuminate\Http\Request;

class ReservaEquipoArticuloRepository extends BaseRepository
{
    public function __construct(ReservaEquipoArticulo $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

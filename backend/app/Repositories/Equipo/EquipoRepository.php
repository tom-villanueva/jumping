<?php

namespace App\Repositories\Equipo;

use App\Core\BaseRepository;
use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoRepository extends BaseRepository
{
    public function __construct(Equipo $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

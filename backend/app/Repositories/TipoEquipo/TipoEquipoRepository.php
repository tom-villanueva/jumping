<?php

namespace App\Repositories\TipoEquipo;

use App\Core\BaseRepository;
use App\Models\TipoEquipo;
use Illuminate\Http\Request;

class TipoEquipoRepository extends BaseRepository
{
    public function __construct(TipoEquipo $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

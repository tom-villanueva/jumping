<?php

namespace App\Repositories\TipoArticulo;

use App\Core\BaseRepository;
use App\Models\TipoArticulo;
use Illuminate\Http\Request;

class TipoArticuloRepository extends BaseRepository
{
    public function __construct(TipoArticulo $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

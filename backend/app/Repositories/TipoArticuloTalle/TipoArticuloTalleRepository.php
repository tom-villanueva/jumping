<?php

namespace App\Repositories\TipoArticuloTalle;

use App\Core\BaseRepository;
use App\Models\TipoArticuloTalle;
use Illuminate\Http\Request;

class TipoArticuloTalleRepository extends BaseRepository
{
    public function __construct(TipoArticuloTalle $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

<?php

namespace App\Repositories\Traslado;

use App\Core\BaseRepository;
use App\Models\Traslado;
use Illuminate\Http\Request;

class TrasladoRepository extends BaseRepository
{
    public function __construct(Traslado $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

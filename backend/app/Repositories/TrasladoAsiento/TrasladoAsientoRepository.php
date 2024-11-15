<?php

namespace App\Repositories\TrasladoAsiento;

use App\Core\BaseRepository;
use App\Models\TrasladoAsiento;
use Illuminate\Http\Request;

class TrasladoAsientoRepository extends BaseRepository
{
    public function __construct(TrasladoAsiento $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

<?php

namespace App\Repositories\TrasladoPrecio;

use App\Core\BaseRepository;
use App\Models\TrasladoPrecio;
use Illuminate\Http\Request;

class TrasladoPrecioRepository extends BaseRepository
{
    public function __construct(TrasladoPrecio $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

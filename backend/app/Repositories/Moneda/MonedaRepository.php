<?php

namespace App\Repositories\Moneda;

use App\Core\BaseRepository;
use App\Models\Moneda;
use Illuminate\Http\Request;

class MonedaRepository extends BaseRepository
{
    public function __construct(Moneda $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

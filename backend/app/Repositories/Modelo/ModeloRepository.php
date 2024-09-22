<?php

namespace App\Repositories\Modelo;

use App\Core\BaseRepository;
use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloRepository extends BaseRepository
{
    public function __construct(Modelo $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

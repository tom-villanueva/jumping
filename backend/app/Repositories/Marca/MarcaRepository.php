<?php

namespace App\Repositories\Marca;

use App\Core\BaseRepository;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaRepository extends BaseRepository
{
    public function __construct(Marca $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

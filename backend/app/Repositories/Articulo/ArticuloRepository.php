<?php

namespace App\Repositories\Articulo;

use App\Core\BaseRepository;
use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloRepository extends BaseRepository
{
    public function __construct(Articulo $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

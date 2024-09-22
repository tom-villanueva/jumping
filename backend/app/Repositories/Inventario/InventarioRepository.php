<?php

namespace App\Repositories\Inventario;

use App\Core\BaseRepository;
use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioRepository extends BaseRepository
{
    public function __construct(Inventario $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

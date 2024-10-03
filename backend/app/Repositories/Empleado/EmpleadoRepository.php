<?php

namespace App\Repositories\Empleado;

use App\Core\BaseRepository;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoRepository extends BaseRepository
{
    public function __construct(Empleado $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

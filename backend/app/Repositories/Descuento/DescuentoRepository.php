<?php

namespace App\Repositories\Descuento;

use App\Core\BaseRepository;
use App\Models\Descuento;
use Illuminate\Http\Request;

class DescuentoRepository extends BaseRepository
{
    public function __construct(Descuento $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

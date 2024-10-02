<?php

namespace App\Repositories\MetodoPago;

use App\Core\BaseRepository;
use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoRepository extends BaseRepository
{
    public function __construct(MetodoPago $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

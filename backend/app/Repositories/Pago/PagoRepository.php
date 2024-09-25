<?php

namespace App\Repositories\Pago;

use App\Core\BaseRepository;
use App\Models\Pago;
use Illuminate\Http\Request;

class PagoRepository extends BaseRepository
{
    public function __construct(Pago $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

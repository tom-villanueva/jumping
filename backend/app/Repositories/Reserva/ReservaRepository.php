<?php

namespace App\Repositories\Reserva;

use App\Core\BaseRepository;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaRepository extends BaseRepository
{
    public function __construct(Reserva $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

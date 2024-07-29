<?php

namespace App\Repositories\Estado;

use App\Core\BaseRepository;
use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoRepository extends BaseRepository
{
    public function __construct(Estado $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

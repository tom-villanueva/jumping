<?php

namespace App\Repositories\Talle;

use App\Core\BaseRepository;
use App\Models\Talle;
use Illuminate\Http\Request;

class TalleRepository extends BaseRepository
{
    public function __construct(Talle $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

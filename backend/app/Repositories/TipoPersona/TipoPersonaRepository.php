<?php

namespace App\Repositories\TipoPersona;

use App\Core\BaseRepository;
use App\Models\TipoPersona;
use Illuminate\Http\Request;

class TipoPersonaRepository extends BaseRepository
{
    public function __construct(TipoPersona $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

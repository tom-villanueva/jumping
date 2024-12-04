<?php

namespace App\Repositories\Cliente;

use App\Core\BaseRepository;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteRepository extends BaseRepository
{
    public function __construct(Cliente $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}

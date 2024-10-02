<?php
namespace App\Http\Controllers\Moneda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Moneda\MonedaRepository;
use App\Http\Requests\Moneda\StoreMonedaRequest;

class StoreMonedaController extends Controller
{
    private $repository;

    public function __construct(MonedaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreMonedaRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}
<?php
namespace App\Http\Controllers\MetodoPago;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MetodoPago\MetodoPagoRepository;
use App\Http\Requests\MetodoPago\StoreMetodoPagoRequest;

class StoreMetodoPagoController extends Controller
{
    private $repository;

    public function __construct(MetodoPagoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreMetodoPagoRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}
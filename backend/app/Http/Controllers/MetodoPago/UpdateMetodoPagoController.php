<?php
namespace App\Http\Controllers\MetodoPago;

use App\Http\Controllers\Controller;
use App\Repositories\MetodoPago\MetodoPagoRepository;
use App\Http\Requests\MetodoPago\UpdateMetodoPagoRequest;

class UpdateMetodoPagoController extends Controller
{
    private $repository;

    public function __construct(MetodoPagoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateMetodoPagoRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}

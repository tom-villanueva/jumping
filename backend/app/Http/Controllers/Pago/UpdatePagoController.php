<?php
namespace App\Http\Controllers\Pago;

use App\Http\Controllers\Controller;
use App\Repositories\Pago\PagoRepository;
use App\Http\Requests\Pago\UpdatePagoRequest;

class UpdatePagoController extends Controller
{
    private $repository;

    public function __construct(PagoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdatePagoRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}

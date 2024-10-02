<?php
namespace App\Http\Controllers\Moneda;

use App\Http\Controllers\Controller;
use App\Repositories\Moneda\MonedaRepository;
use App\Http\Requests\Moneda\UpdateMonedaRequest;

class UpdateMonedaController extends Controller
{
    private $repository;

    public function __construct(MonedaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateMonedaRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}

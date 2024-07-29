<?php
namespace App\Http\Controllers\Estado;

use App\Http\Controllers\Controller;
use App\Repositories\Estado\EstadoRepository;
use App\Http\Requests\Estado\UpdateEstadoRequest;

class UpdateEstadoController extends Controller
{
    private $repository;

    public function __construct(EstadoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateEstadoRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}

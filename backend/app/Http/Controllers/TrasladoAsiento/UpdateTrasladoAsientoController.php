<?php
namespace App\Http\Controllers\TrasladoAsiento;

use App\Http\Controllers\Controller;
use App\Repositories\TrasladoAsiento\TrasladoAsientoRepository;
use App\Http\Requests\TrasladoAsiento\UpdateTrasladoAsientoRequest;

class UpdateTrasladoAsientoController extends Controller
{
    private $repository;

    public function __construct(TrasladoAsientoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateTrasladoAsientoRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}

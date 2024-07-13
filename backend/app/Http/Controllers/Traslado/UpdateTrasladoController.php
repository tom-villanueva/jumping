<?php
namespace App\Http\Controllers\Traslado;

use App\Http\Controllers\Controller;
use App\Repositories\Traslado\TrasladoRepository;
use App\Http\Requests\Traslado\UpdateTrasladoRequest;

class UpdateTrasladoController extends Controller
{
    private $repository;

    public function __construct(TrasladoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateTrasladoRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}

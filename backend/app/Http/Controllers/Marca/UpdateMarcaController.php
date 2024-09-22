<?php
namespace App\Http\Controllers\Marca;

use App\Http\Controllers\Controller;
use App\Repositories\Marca\MarcaRepository;
use App\Http\Requests\Marca\UpdateMarcaRequest;

class UpdateMarcaController extends Controller
{
    private $repository;

    public function __construct(MarcaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateMarcaRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}

<?php
namespace App\Http\Controllers\EquipoPrecio;

use App\Http\Controllers\Controller;
use App\Repositories\EquipoPrecio\EquipoPrecioRepository;
use App\Http\Requests\EquipoPrecio\UpdateEquipoPrecioRequest;

class UpdateEquipoPrecioController extends Controller
{
    private $repository;

    public function __construct(EquipoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateEquipoPrecioRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}

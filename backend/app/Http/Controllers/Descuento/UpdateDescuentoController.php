<?php
namespace App\Http\Controllers\Descuento;

use App\Http\Controllers\Controller;
use App\Repositories\Descuento\DescuentoRepository;
use App\Http\Requests\Descuento\UpdateDescuentoRequest;

class UpdateDescuentoController extends Controller
{
    private $repository;

    public function __construct(DescuentoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateDescuentoRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}

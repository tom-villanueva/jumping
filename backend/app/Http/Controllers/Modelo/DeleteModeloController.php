<?php
namespace App\Http\Controllers\Modelo;

use App\Http\Controllers\Controller;
use App\Repositories\Modelo\ModeloRepository;

class DeleteModeloController extends Controller
{
    private $repository;

    public function __construct(ModeloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}

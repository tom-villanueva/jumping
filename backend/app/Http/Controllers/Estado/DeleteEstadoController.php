<?php
namespace App\Http\Controllers\Estado;

use App\Http\Controllers\Controller;
use App\Repositories\Estado\EstadoRepository;

class DeleteEstadoController extends Controller
{
    private $repository;

    public function __construct(EstadoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}

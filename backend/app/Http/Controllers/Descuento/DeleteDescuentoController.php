<?php
namespace App\Http\Controllers\Descuento;

use App\Http\Controllers\Controller;
use App\Repositories\Descuento\DescuentoRepository;

class DeleteDescuentoController extends Controller
{
    private $repository;

    public function __construct(DescuentoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}

<?php
namespace App\Http\Controllers\MetodoPago;

use App\Http\Controllers\Controller;
use App\Repositories\MetodoPago\MetodoPagoRepository;

class DeleteMetodoPagoController extends Controller
{
    private $repository;

    public function __construct(MetodoPagoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}

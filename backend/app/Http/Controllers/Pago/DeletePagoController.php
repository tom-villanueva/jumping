<?php
namespace App\Http\Controllers\Pago;

use App\Http\Controllers\Controller;
use App\Repositories\Pago\PagoRepository;

class DeletePagoController extends Controller
{
    private $repository;

    public function __construct(PagoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}

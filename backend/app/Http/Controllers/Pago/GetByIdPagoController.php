<?php
namespace App\Http\Controllers\Pago;

use App\Http\Controllers\Controller;
use App\Repositories\Pago\PagoRepository;

class GetByIdPagoController extends Controller
{
    private $repository;

    public function __construct(PagoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}
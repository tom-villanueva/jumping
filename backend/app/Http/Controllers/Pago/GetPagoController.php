<?php
namespace App\Http\Controllers\Pago;

use App\Http\Controllers\Controller;
use App\Repositories\Pago\PagoRepository;

class GetPagoController extends Controller
{
    private $repository;

    public function __construct(PagoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}

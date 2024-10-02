<?php
namespace App\Http\Controllers\MetodoPago;

use App\Http\Controllers\Controller;
use App\Repositories\MetodoPago\MetodoPagoRepository;

class GetMetodoPagoController extends Controller
{
    private $repository;

    public function __construct(MetodoPagoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}

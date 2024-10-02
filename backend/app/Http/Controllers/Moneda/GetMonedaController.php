<?php
namespace App\Http\Controllers\Moneda;

use App\Http\Controllers\Controller;
use App\Repositories\Moneda\MonedaRepository;

class GetMonedaController extends Controller
{
    private $repository;

    public function __construct(MonedaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}

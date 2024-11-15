<?php
namespace App\Http\Controllers\TrasladoAsiento;

use App\Http\Controllers\Controller;
use App\Repositories\TrasladoAsiento\TrasladoAsientoRepository;

class GetTrasladoAsientoController extends Controller
{
    private $repository;

    public function __construct(TrasladoAsientoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}

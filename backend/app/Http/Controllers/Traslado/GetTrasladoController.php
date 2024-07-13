<?php
namespace App\Http\Controllers\Traslado;

use App\Http\Controllers\Controller;
use App\Repositories\Traslado\TrasladoRepository;

class GetTrasladoController extends Controller
{
    private $repository;

    public function __construct(TrasladoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}

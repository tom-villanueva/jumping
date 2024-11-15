<?php
namespace App\Http\Controllers\TrasladoAsiento;

use App\Http\Controllers\Controller;
use App\Repositories\TrasladoAsiento\TrasladoAsientoRepository;

class DeleteTrasladoAsientoController extends Controller
{
    private $repository;

    public function __construct(TrasladoAsientoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}

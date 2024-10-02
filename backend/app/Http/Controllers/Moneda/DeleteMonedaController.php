<?php
namespace App\Http\Controllers\Moneda;

use App\Http\Controllers\Controller;
use App\Repositories\Moneda\MonedaRepository;

class DeleteMonedaController extends Controller
{
    private $repository;

    public function __construct(MonedaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}

<?php
namespace App\Http\Controllers\Traslado;

use App\Http\Controllers\Controller;
use App\Repositories\Traslado\TrasladoRepository;

class DeleteTrasladoController extends Controller
{
    private $repository;

    public function __construct(TrasladoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}

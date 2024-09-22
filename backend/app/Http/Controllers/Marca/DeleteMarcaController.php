<?php
namespace App\Http\Controllers\Marca;

use App\Http\Controllers\Controller;
use App\Repositories\Marca\MarcaRepository;

class DeleteMarcaController extends Controller
{
    private $repository;

    public function __construct(MarcaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}

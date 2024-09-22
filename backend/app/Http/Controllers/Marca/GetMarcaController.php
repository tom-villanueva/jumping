<?php
namespace App\Http\Controllers\Marca;

use App\Http\Controllers\Controller;
use App\Repositories\Marca\MarcaRepository;

class GetMarcaController extends Controller
{
    private $repository;

    public function __construct(MarcaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}

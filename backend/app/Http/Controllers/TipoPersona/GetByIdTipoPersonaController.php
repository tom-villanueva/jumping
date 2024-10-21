<?php
namespace App\Http\Controllers\TipoPersona;

use App\Http\Controllers\Controller;
use App\Repositories\TipoPersona\TipoPersonaRepository;

class GetByIdTipoPersonaController extends Controller
{
    private $repository;

    public function __construct(TipoPersonaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}
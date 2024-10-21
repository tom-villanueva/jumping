<?php
namespace App\Http\Controllers\TipoPersona;

use App\Http\Controllers\Controller;
use App\Repositories\TipoPersona\TipoPersonaRepository;

class GetTipoPersonaController extends Controller
{
    private $repository;

    public function __construct(TipoPersonaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}

<?php
namespace App\Http\Controllers\Marca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Marca\MarcaRepository;
use App\Http\Requests\Marca\StoreMarcaRequest;

class StoreMarcaController extends Controller
{
    private $repository;

    public function __construct(MarcaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreMarcaRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}
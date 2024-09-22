<?php
namespace App\Http\Controllers\Talle;

use App\Http\Controllers\Controller;
use App\Repositories\Talle\TalleRepository;
use App\Http\Requests\Talle\UpdateTalleRequest;
use Illuminate\Support\Facades\DB;

class UpdateTalleController extends Controller
{
    private $repository;

    public function __construct(TalleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateTalleRequest $request, $id)
    {
        DB::beginTransaction();

        $result = $this->repository->update($id, $request->all());

        DB::commit();

        return response()->json($result);
    }
}

<?php
namespace App\Http\Controllers\Equipo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipo\UpdateEquipoThumbnailRequest;
use App\Repositories\Equipo\EquipoRepository;

class UpdateEquipoThumbnailController extends Controller
{
    private $repository;

    public function __construct(EquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateEquipoThumbnailRequest $request, $id)
    {
        $equipo = $this->repository->find($id);

        $equipo
            ->addMediaFromRequest('thumbnail')
            ->toMediaCollection('thumbnail');
        
        return response()->json([
            'url' => $equipo->getFirstMedia('thumbnail')->getUrl('thumb')
        ]);
    }
}
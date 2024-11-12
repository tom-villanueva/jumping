<?php
namespace App\Http\Controllers\Reserva;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\EnviarConfirmacion;
use App\Repositories\Reserva\ReservaRepository;
use Illuminate\Support\Facades\Mail;

class EnviarMailReservaConfirmacionController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request, $id)
    {
        $reserva = $this->repository->find($id);

        Mail::to($reserva->email)->send(new EnviarConfirmacion($reserva));

        return response()->json($reserva);
    }
}

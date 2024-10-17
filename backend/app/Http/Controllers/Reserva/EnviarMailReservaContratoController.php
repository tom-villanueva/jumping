<?php
namespace App\Http\Controllers\Reserva;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\EnviarContrato;
use App\Repositories\Reserva\ReservaRepository;
use Illuminate\Support\Facades\Mail;

class EnviarMailReservaContratoController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request, $id)
    {
        $reserva = $this->repository->find($id);

        Mail::to($reserva->email)->send(new EnviarContrato($reserva));

        return response()->json($reserva);
    }
}

<?php
namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GetMisReservasController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke()
    {
        $user = Auth::guard('web')->user();

        $cliente = $user->cliente;

        $reservas = $cliente->reservas;
       
        return response()->json($reservas);
    }
}

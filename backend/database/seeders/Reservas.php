<?php

namespace Database\Seeders;

use App\Models\Estado;
use App\Models\Reserva;
use Illuminate\Database\Seeder;

class Reservas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        Reserva::truncate();

        $talles = [
            "Pendiente",
            "Pagada",
            "Cancelada",
            "Finalizada"
        ];

        foreach ($talles as $talle) {
            Reserva::updateOrCreate([
                "descripcion" => $talle,
            ]);
        }

        // enable fk check
    }
}
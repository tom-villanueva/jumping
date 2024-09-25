<?php

namespace Database\Seeders;

use App\Models\MetodoPago;
use Illuminate\Database\Seeder;

class MetodoPagos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        MetodoPago::truncate();

        $metodos = [
            "Transferencia",
            "Débito",
            "Crédito"
        ];

        foreach ($metodos as $metodo) {
            MetodoPago::updateOrCreate([
              "descripcion" => $metodo,
            ]);
        }
        

        // enable fk check
    }
}
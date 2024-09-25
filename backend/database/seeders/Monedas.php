<?php

namespace Database\Seeders;

use App\Models\Moneda;
use Illuminate\Database\Seeder;

class Monedas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        Moneda::truncate();

        $monedas = [
            "ARS",
            "USD",
            "BRL",
            "EUR"
        ];

        foreach ($monedas as $moneda) {
            Moneda::updateOrCreate([
              "descripcion" => $moneda,
            ]);
        }
        

        // enable fk check
    }
}
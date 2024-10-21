<?php

namespace Database\Seeders;

use App\Models\MetodoPago;
use App\Models\TipoPersona;
use Illuminate\Database\Seeder;

class TipoPersonas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        TipoPersona::truncate();

        $metodos = [
            'Cliente Tier 1',
            'Cliente Tier 2',
            'Cliente Tier 3',
        ];

        foreach ($metodos as $metodo) {
            TipoPersona::updateOrCreate([
              "descripcion" => $metodo,
              "descuento_id" => 1
            ]);
        }
        

        // enable fk check
    }
}
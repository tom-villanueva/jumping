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
            'Estándar',
            'VIP',
            'Premium',
        ];

        foreach ($metodos as $metodo) {
            TipoPersona::updateOrCreate([
              "descripcion" => $metodo,
              "descuento_id" => $metodo == 'VIP' || $metodo == 'Premium' ? 1 : null
            ]);
        }
        

        // enable fk check
    }
}
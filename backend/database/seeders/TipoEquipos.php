<?php

namespace Database\Seeders;

use App\Models\TipoEquipo;
use Illuminate\Database\Seeder;

class TipoEquipos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        TipoEquipo::truncate();

        $metodos = [
            'Ski',
            'Snowboard',
            'Accesorios',
        ];

        foreach ($metodos as $metodo) {
            TipoEquipo::updateOrCreate([
              "descripcion" => $metodo,
            ]);
        }
        

        // enable fk check
    }
}
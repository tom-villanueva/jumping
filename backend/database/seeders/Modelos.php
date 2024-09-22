<?php

namespace Database\Seeders;

use App\Models\Articulo;
use App\Models\Modelo;
use Illuminate\Database\Seeder;

class Modelos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        Modelo::truncate();

        $modelos = [
            "xyz",
            "x",
            "y",
            "z"
        ];

        foreach ($modelos as $modelo) {
            Modelo::updateOrCreate([
              "descripcion" => $modelo,
              'marca_id' => 1
            ]);
        }
        

        // enable fk check
    }
}
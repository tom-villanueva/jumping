<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;

class Marcas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        Marca::truncate();

        $marcas = [
            "Head",
            "Fisher"
        ];

        foreach ($marcas as $marca) {
            Marca::updateOrCreate([
              "descripcion" => $marca,
            ]);
        }
        

        // enable fk check
    }
}
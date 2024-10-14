<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            "Sin marca",
            "Alpina", 
            "ATOMIC",
            "Blizzard",
            "BRIKO",
            "BURTON",
            "CAPITA",
            "CELSIUS",
            "Dalbello",
            "DC",
            "DEELUXE",
            "Escape",
            "FIFTY ONE", 
            "Fischer",
            "FORUM",
            "GNU",
            "Head",
            "K2",
            "KAN",
            "Kemper",
            "LAMAR",
            "LTD",
            "MORROW",
            "NITRO",
            "Nordica",
            "RIDE",
            "ROSSIGNOL",
            "Salomon",
            "SANTA CRUZ", 
            "SAPIENT",
            "SIMS",
            "TECHNINE",
            "Tecnica",
            "UVEX",
        ];

        foreach ($marcas as $marca) {
            Marca::updateOrCreate([
              "descripcion" => Str::upper($marca),
            ]);
        }

        // enable fk check
    }
}
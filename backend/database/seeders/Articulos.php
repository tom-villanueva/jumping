<?php

namespace Database\Seeders;

use App\Models\Articulo;
use Illuminate\Database\Seeder;

class Articulos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        Articulo::truncate();

        $tipoArticuloTalle = [
            1,6,17
        ];

        foreach ($tipoArticuloTalle as $tat) {
            for ($i=0; $i < 10; $i++) { 
                Articulo::factory()->create([
                    'tipo_articulo_talle_id' => $tat
                ]); 
            }
        }

        // enable fk check
    }
}
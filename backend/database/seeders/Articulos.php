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


        for ($i=0; $i < 10; $i++) { 
            Articulo::factory()->create(); 
        }
        

        // enable fk check
    }
}
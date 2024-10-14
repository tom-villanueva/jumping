<?php

namespace Database\Seeders;

use App\Models\Estado;
use App\Models\TrasladoPrecio;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TrasladoPrecios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        TrasladoPrecio::truncate();

        TrasladoPrecio::updateOrCreate([
            "precio" => 20000,
            "fecha_desde" => Carbon::today()->format('Y-m-d'),
            "fecha_hasta" => null
        ]);
        
        // enable fk check
    }
}
<?php

namespace Database\Seeders;

use App\Models\Reserva;
use Illuminate\Database\Seeder;

class Reservas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        Reserva::truncate();

        Reserva::factory()->count(10)->create();

        // enable fk check
    }
}
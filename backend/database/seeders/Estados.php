<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class Estados extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        Estado::truncate();

        $talles = [
            "Pendiente",
            "Pagada",
            "Cancelada",
            "Finalizada"
        ];

        foreach ($talles as $talle) {
            Estado::updateOrCreate([
                "descripcion" => $talle,
            ]);
        }

        // enable fk check
    }
}
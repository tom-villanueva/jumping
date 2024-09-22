<?php

namespace Database\Seeders;

use App\Models\TipoArticulo;
use Illuminate\Database\Seeder;

class TipoArticulos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TipoArticulo::truncate();

        $tipos = [
            "Esquí",
            "Snowboard",
            "Bastones",
            "Botas de esquí",
            "Botas de snowboard"
        ];

        foreach ($tipos as $tipo) {
            $model = TipoArticulo::updateOrCreate([
                "descripcion" => $tipo,
            ]);
        }

        // enable fk check
    }
}

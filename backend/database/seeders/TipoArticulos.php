<?php

namespace Database\Seeders;

use App\Models\TipoArticulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            $model->tipo_articulo_talle()->attach([1,2,3,4,5]);
        }

        // enable fk check
    }
}

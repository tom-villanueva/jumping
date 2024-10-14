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
            "Ski", // 1
            "Ski alta gama", // 2
            "Ski premium", // 3
            "Snowboard", // 4
            "Snowboard premium", // 5
            "Bota de esquí", // 6
            "Bota de snowboard", // 7
            "Bota Apreski", // 8
            "Bastones", // 9
            "Guante", // 10
            "Campera", // 11
            "Campera premium", // 12
            "Pantalón", // 13
            "Pantalón premium", // 14
            "Enterito niño", // 15
            "Antiparra", // 16
            "Casco", // 17
        ];

        foreach ($tipos as $tipo) {
            TipoArticulo::updateOrCreate([
                "descripcion" => $tipo,
            ]);
        }

        // enable fk check
    }
}

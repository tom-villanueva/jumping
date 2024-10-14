<?php

namespace Database\Seeders;

use App\Models\Talle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Talles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        Talle::truncate();

        $talles = [
            [
                "medida" => " 100",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 100",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 100",
                "tipo_articulo_id" => 9
            ],
            [
                "medida" => " 105",
                "tipo_articulo_id" => 9
            ],
            [
                "medida" => " 105",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 105",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 110",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 110",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 110",
                "tipo_articulo_id" => 9
            ],
            [
                "medida" => " 115",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 115",
                "tipo_articulo_id" => 9
            ],
            [
                "medida" => " 115",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 120",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 120",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 120",
                "tipo_articulo_id" => 9
            ],
            [
                "medida" => " 125",
                "tipo_articulo_id" => 9
            ],
            [
                "medida" => " 125",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 125",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 130",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 130",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 135",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 135",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 140",
                "tipo_articulo_id" => 2
            ],
            [
                "medida" => " 140",
                "tipo_articulo_id" => 3
            ],
            [
                "medida" => " 140",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 140",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 140",
                "tipo_articulo_id" => 5
            ],
            [
                "medida" => " 145",
                "tipo_articulo_id" => 2
            ],
            [
                "medida" => " 145",
                "tipo_articulo_id" => 3
            ],
            [
                "medida" => " 145",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 145",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 145",
                "tipo_articulo_id" => 5
            ],
            [
                "medida" => " 15",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 15,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 150",
                "tipo_articulo_id" => 2
            ],
            [
                "medida" => " 150",
                "tipo_articulo_id" => 3
            ],
            [
                "medida" => " 150",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 150",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 150",
                "tipo_articulo_id" => 5
            ],
            [
                "medida" => " 155",
                "tipo_articulo_id" => 2
            ],
            [
                "medida" => " 155",
                "tipo_articulo_id" => 3
            ],
            [
                "medida" => " 155",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 155",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 155",
                "tipo_articulo_id" => 5
            ],
            [
                "medida" => " 16",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 16,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 160",
                "tipo_articulo_id" => 2
            ],
            [
                "medida" => " 160",
                "tipo_articulo_id" => 3
            ],
            [
                "medida" => " 160",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 160",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 160",
                "tipo_articulo_id" => 5
            ],
            [
                "medida" => " 165",
                "tipo_articulo_id" => 2
            ],
            [
                "medida" => " 165",
                "tipo_articulo_id" => 3
            ],
            [
                "medida" => " 165",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 165",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 165",
                "tipo_articulo_id" => 5
            ],
            [
                "medida" => " 17",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 17,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 17,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 170",
                "tipo_articulo_id" => 2
            ],
            [
                "medida" => " 170",
                "tipo_articulo_id" => 3
            ],
            [
                "medida" => " 170",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 170",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 170",
                "tipo_articulo_id" => 5
            ],
            [
                "medida" => " 174",
                "tipo_articulo_id" => 2
            ],
            [
                "medida" => " 175",
                "tipo_articulo_id" => 2
            ],
            [
                "medida" => " 175",
                "tipo_articulo_id" => 3
            ],
            [
                "medida" => " 175",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 18",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 18",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 18,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 18,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 180",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 180",
                "tipo_articulo_id" => 3
            ],
            [
                "medida" => " 19",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 19",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 19,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 19,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 20",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 20",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 20,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 20,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 21",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 21",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 21,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 21,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 22",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 22,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 22,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 23",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 23",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 23,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 23,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 24",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 24",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 24,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 24,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 25",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 25",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 25,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 25,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 26",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 26",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 26,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 26,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 27",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 27",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 27,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 27,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 28",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 28",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 28,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 28,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 29",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 29",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 29,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 29,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 30",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 30",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 30,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 30,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 31",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 31",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 31,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 31,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 32",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 32,5",
                "tipo_articulo_id" => 6
            ],
            [
                "medida" => " 32,5",
                "tipo_articulo_id" => 7
            ],
            [
                "medida" => " 70",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 80",
                "tipo_articulo_id" => 9
            ],
            [
                "medida" => " 80",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 90",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " 90",
                "tipo_articulo_id" => 9
            ],
            [
                "medida" => " 90",
                "tipo_articulo_id" => 4
            ],
            [
                "medida" => " 95",
                "tipo_articulo_id" => 1
            ],
            [
                "medida" => " L",
                "tipo_articulo_id" => 11
            ],
            [
                "medida" => " L",
                "tipo_articulo_id" => 10
            ],
            [
                "medida" => " L",
                "tipo_articulo_id" => 13
            ],
            [
                "medida" => " M",
                "tipo_articulo_id" => 11
            ],
            [
                "medida" => " M",
                "tipo_articulo_id" => 10
            ],
            [
                "medida" => " M",
                "tipo_articulo_id" => 13
            ],
            [
                "medida" => " S",
                "tipo_articulo_id" => 11
            ],
            [
                "medida" => " S",
                "tipo_articulo_id" => 10
            ],
            [
                "medida" => " S",
                "tipo_articulo_id" => 13
            ],
            [
                "medida" => " XL",
                "tipo_articulo_id" => 11
            ],
            [
                "medida" => " XL",
                "tipo_articulo_id" => 10
            ],
            [
                "medida" => " XL",
                "tipo_articulo_id" => 13
            ],
            [
                "medida" => " XS",
                "tipo_articulo_id" => 11
            ],
            [
                "medida" => " XS",
                "tipo_articulo_id" => 10
            ],
            [
                "medida" => " XS",
                "tipo_articulo_id" => 13
            ],
            [
                "medida" => " XXL",
                "tipo_articulo_id" => 13
            ]
        ];

        foreach ($talles as $talle) {
            $newTalle = Talle::updateOrCreate([
                "descripcion" => Str::trim($talle["medida"]),
            ],[
                "descripcion" => Str::trim($talle["medida"]),
            ]);

            $newTalle->tipos()->attach($talle["tipo_articulo_id"]);
        }

        // enable fk check
    }
}

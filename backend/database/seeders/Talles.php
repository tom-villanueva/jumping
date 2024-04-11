<?php

namespace Database\Seeders;

use App\Models\Talle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            "XS",
            "SM",
            "MD",
            "LG",
            "XL"
        ];

        foreach ($talles as $talle) {
            Talle::updateOrCreate([
                "descripcion" => $talle,
            ]);
        }

        // enable fk check
    }
}

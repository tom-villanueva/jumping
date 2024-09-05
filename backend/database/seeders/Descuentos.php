<?php

namespace Database\Seeders;

use App\Models\Descuento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Descuentos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Descuento::truncate();

        $descuentos =[[
                'valor' => 10,
                'descripcion' => "10%",
                'tipo_descuento' => true
            ],
            [
                'valor' => 20,
                'descripcion' => "20%",
                'tipo_descuento' => true
            ],
            [
                'valor' => 30,
                'descripcion' => "30%",
                'tipo_descuento' => true
            ],
            [
                'valor' => 40,
                'descripcion' => "40%",
                'tipo_descuento' => true
            ],
            [
                'valor' => 50,
                'descripcion' => "50%",
                'tipo_descuento' => true
            ],
            [
                'valor' => 60,
                'descripcion' => "60%",
                'tipo_descuento' => true
            ],
            [
                'valor' => 70,
                'descripcion' => "70%",
                'tipo_descuento' => true
            ]
        ];

        foreach ($descuentos as $descuento) {
            Descuento::updateOrCreate([
                'valor' => $descuento['valor'],
                'descripcion' => $descuento['descripcion'],
                'tipo_descuento' => $descuento['tipo_descuento']
            ]);
        }

    }
}

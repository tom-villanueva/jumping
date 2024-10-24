<?php

namespace Database\Seeders;

use App\Models\MetodoPago;
use Illuminate\Database\Seeder;

class MetodoPagos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        MetodoPago::truncate();

        $metodos = [
            "Efectivo",
            "Tarjeta de crédito",
            "Mercado Pago",
            "Transferencia"
        ];

        foreach ($metodos as $metodo) {
            MetodoPago::updateOrCreate([
              "descripcion" => $metodo,
            ]);
        }

        MetodoPago::where('descripcion', 'Efectivo')
            ->update(['descuento_id' => 1]);
        
        // enable fk check
    }
}
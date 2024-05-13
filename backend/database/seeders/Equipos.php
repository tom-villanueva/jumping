<?php

namespace Database\Seeders;

use App\Models\Equipo;
use App\Models\EquipoPrecio;
use Illuminate\Database\Seeder;

class Equipos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipo::truncate();

        $equipos = [
            1 => ["descripcion" => "Equipo de esquí completo", "ids" => [1,3,4]],
            2 => ["descripcion" => "Equipo de snowboard completo", "ids" => [2,5]],
        ];

        foreach ($equipos as $equipo) {
            $model = Equipo::updateOrCreate([
                "descripcion" => $equipo['descripcion'],
                // "precio" => 20000,
                "disponible" => true
            ]);

            $equipoPrecio = EquipoPrecio::updateOrCreate([
                "precio" => 20000,
                "equipo_id" => $model->id
            ]);
            
            $model->equipo_tipo_articulo()->attach($equipo['ids']);
        }

        // enable fk check
    }
}

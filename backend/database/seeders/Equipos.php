<?php

namespace Database\Seeders;

use App\Models\Equipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                "precio" => 20000,
                "disponible" => true
            ]);
            
            $model->equipo_tipo_articulo()->attach($equipo['ids']);
        }

        // enable fk check
    }
}

<?php

namespace Database\Factories;

use App\Models\EquipoPrecio;
use App\Models\ReservaEquipo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ReservaEquipoPrecioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reserva_equipo_id' => ReservaEquipo::factory()->create()->id,
            'equipo_precio_id' => EquipoPrecio::factory()->create()->id,
            'fecha_desde' => Carbon::today()->format('Y-m-d'),
            'fecha_hasta' => Carbon::today()->addDay(1)->format('Y-m-d'),
            'precio' => 100
        ];
    }
}
<?php

namespace Database\Factories;

use App\Models\Equipo;
use App\Models\Reserva;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ReservaEquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'altura' => fake()->randomNumber(3),
            'peso' => fake()->randomNumber(2),
            'num_calzado' => fake()->randomNumber(2),
            'nombre' => fake()->word(),
            'apellido' => fake()->word(),
            'reserva_id' => Reserva::factory()->create()->id,
            'equipo_id' => Equipo::factory()->create()->id
        ];
    }
}

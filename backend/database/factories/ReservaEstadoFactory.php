<?php

namespace Database\Factories;

use App\Models\Reserva;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ReservaEstadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reserva_id' => Reserva::factory()->create()->id,
            'estado_id' => 1
        ];
    }
}
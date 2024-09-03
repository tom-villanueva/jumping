<?php

namespace Database\Factories;

use App\Models\EquipoDescuento;
use App\Models\ReservaEquipo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ReservaEquipoDescuentoFactory extends Factory
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
            'equipo_descuento_id' => EquipoDescuento::factory()->create()->id
        ];
    }
}
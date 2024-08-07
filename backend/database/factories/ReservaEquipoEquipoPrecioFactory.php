<?php

namespace Database\Factories;

use App\Models\EquipoDescuento;
use App\Models\EquipoPrecio;
use App\Models\ReservaEquipo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ReservaEquipoEquipoPrecioFactory extends Factory
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
            'equipo_descuento_id' => EquipoDescuento::factory()->create()->id
        ];
    }
}

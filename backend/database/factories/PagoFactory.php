<?php

namespace Database\Factories;

use App\Models\Reserva;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class PagoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total' => fake()->numberBetween(),
            'status' => 'success',
            'numero_comprobante' => fake()->word(),
            'reserva_id' => Reserva::factory()->create()->id,
            'metodo_pago_id' => 1,
            'moneda_id' => 1,
        ];
    }
}

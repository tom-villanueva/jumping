<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion' => fake()->word(),
            'fecha_expiracion' => Carbon::today()->addDays(10)->format('Y-m-d'),
            'dias' => 2,
            'reserva_id' => Reserva::factory()->create()->id,
            'cliente_id' => Cliente::factory()->create()->id
        ];
    }
}

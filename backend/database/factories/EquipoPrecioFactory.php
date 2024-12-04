<?php

namespace Database\Factories;

use App\Models\Equipo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipoPrecio>
 */
class EquipoPrecioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'equipo_id' => Equipo::factory()->create()->id,
            'precio' => 100,//fake()->randomNumber(3),
            'fecha_desde' => Carbon::now()->format('Y-m-d'),
            'fecha_hasta' => null
        ];
    }
}

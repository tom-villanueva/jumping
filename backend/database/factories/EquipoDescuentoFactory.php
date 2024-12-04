<?php

namespace Database\Factories;

use App\Models\Descuento;
use App\Models\Equipo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoDescuentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $today = Carbon::now()->format('Y-m-d');
        // $todayPlusTenDays = Carbon::now()->addDays(10)->format('Y-m-d');

        return [
            'equipo_id' => Equipo::factory()->create()->id,
            'descuento_id' => 1,
            'fecha_desde' => null,
            'fecha_hasta' => null,
            'dias' => 3
        ];
    }
}
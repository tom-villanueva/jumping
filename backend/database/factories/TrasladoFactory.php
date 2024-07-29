<?php

namespace Database\Factories;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class TrasladoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $today = Carbon::now()->format('Y-m-d');
        $todayPlusOneDay = Carbon::now()->addDay()->format('Y-m-d');

        return [
            'direccion' => 'algo',
            'fecha_desde' => $today,
            'fecha_hasta' => $todayPlusOneDay,
            'reserva_id' => Reserva::factory()->create()->id
        ];
    }
}

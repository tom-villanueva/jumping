<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $today = Carbon::now()->format('Y-m-d');
        // $todayPlusOneDay = Carbon::now()->addDay()->format('Y-m-d');

        return [
            'fecha_prueba' => $this->faker->dateTimeThisMonth(),
            'fecha_desde' => Carbon::now()->addDays($this->faker->numberBetween(1, 10)),
            'fecha_hasta' => Carbon::now()->addDays($this->faker->numberBetween(11, 20)),
            'comentario' => $this->faker->sentence(),
            'user_id' => $this->faker->boolean(50) ? User::factory()->create() : null,
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'telefono' => $this->faker->phoneNumber(),
        ];
    }
}

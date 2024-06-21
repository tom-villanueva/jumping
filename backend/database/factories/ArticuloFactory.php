<?php

namespace Database\Factories;

use App\Models\TipoArticuloTalle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ArticuloFactory extends Factory
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
            'codigo' => fake()->unique()->randomDigit(),
            'observacion' => "",
            'tipo_articulo_talle_id' => TipoArticuloTalle::factory()->create()->id
        ];
    }
}

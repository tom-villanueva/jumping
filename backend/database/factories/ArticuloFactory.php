<?php

namespace Database\Factories;

use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talle;
use App\Models\TipoArticulo;
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
            'codigo' => fake()->unique()->randomNumber(5, true),
            'observacion' => "",
            'tipo_articulo_id' => TipoArticulo::factory()->create()->id,
            'talle_id' => Talle::factory()->create()->id,
            'marca_id' => Marca::factory()->create()->id,
            'modelo_id' => Modelo::factory()->create()->id,
            'nro_serie' => fake()->unique()->randomNumber(5, true)
        ];
    }
}

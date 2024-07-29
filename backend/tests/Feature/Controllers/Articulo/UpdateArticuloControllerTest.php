<?php

namespace Tests\Feature;

use App\Models\Articulo;
use App\Models\TipoArticuloTalle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateArticuloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_articulo_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $tipoArticuloTalle = TipoArticuloTalle::factory()->create();

        $articulo = Articulo::factory()->create([
            'tipo_articulo_talle_id' => $tipoArticuloTalle->id
        ]);
        $articulo2 = Articulo::factory()->create([
            'tipo_articulo_talle_id' => $tipoArticuloTalle->id
        ]);

        $data = [
            'descripcion' => $articulo->descripcion,
            'codigo' => $articulo->codigo,
            'observacion' => '',
            'tipo_articulo_talle_id' => $tipoArticuloTalle->id,
            'nro_serie' => $articulo->nro_serie
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/articulos/{$articulo2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['codigo', 'descripcion', 'nro_serie']);
    }

    public function test_unauthorized_user_can_not_update_articulo()
    {
        $tipoArticuloTalle = TipoArticuloTalle::factory()->create();

        $articulo = Articulo::factory()->create([
            'tipo_articulo_talle_id' => $tipoArticuloTalle->id
        ]);

        $data = [
            'descripcion' => 'Probando cambio',
            'codigo' => $articulo->codigo,
            'observacion' => $articulo->observacion,
            'tipo_articulo_talle_id' => $tipoArticuloTalle->id
        ];

        $response = $this->putJson("/api/articulos/{$articulo->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_articulo()
    {
        $user = $this->createStubUser();
        $tipoArticuloTalle = TipoArticuloTalle::factory()->create();
        $tipoArticuloTalle2 = TipoArticuloTalle::factory()->create();

        $articulo = Articulo::factory()->create([
            'tipo_articulo_talle_id' => $tipoArticuloTalle->id
        ]);

        $data = [
            'descripcion' => 'Probando cambio',
            'codigo' => $articulo->codigo,
            'observacion' => $articulo->observacion,
            'tipo_articulo_talle_id' => $tipoArticuloTalle2->id,
            'nro_serie' => 123,
            'disponible' => true
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/articulos/{$articulo->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "observacion" => null,
            "tipo_articulo_talle_id" => $data['tipo_articulo_talle_id'],
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
        ]);
        
        $this->assertDatabaseHas('articulo', [
            "id" => $response['id'],
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "tipo_articulo_talle_id" => $data['tipo_articulo_talle_id'],
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
        ]);
    }
}
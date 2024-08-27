<?php

namespace Tests\Feature;

use App\Models\Articulo;
use App\Models\TipoArticuloTalle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreArticuloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_articulo()
    {
        // Arrange
		$user = $this->createStubUser();

        $articulo = Articulo::factory()->create();

        $data = [
            'codigo' => '', // Invalid data (codigo is required)
            'descripcion' => '',
			'observacion' => '',
            'tipo_articulo_id' => 25,
            'talle_id' => 25,
			// 'tipo_articulo_talle_id' => 10,
            'nro_serie' => $articulo->nro_serie,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/articulos', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['codigo', 'descripcion', 'tipo_articulo_id', 'talle_id', 'nro_serie']);
    }

	public function test_unauthorized_user_cannot_store_articulo()
	{
		$tipoArticuloTalle = TipoArticuloTalle::factory()->create();

		$response = $this->postJson('/api/articulos', [
            'descripcion' => 'Test Article',
            'codigo' => 1,
            'observacion' => "",
            'tipo_articulo_talle_id' => $tipoArticuloTalle->id
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_articulo()
    {
        $user = $this->createStubUser();
        $tipoArticuloTalle = TipoArticuloTalle::factory()->create();

        $data = [
            'descripcion' => 'Articulo test',
            'codigo' => 1,
            'observacion' => "",
            'talle_id' => $tipoArticuloTalle->talle->id,
            'tipo_articulo_id' => $tipoArticuloTalle->tipo_articulo->id,
            'nro_serie' => 123,
            'disponible' => true
        ];

        // ES NECESARIO EN EL ACTING AS PONERLE EL GUARD, SINO VA AL DEFAULT (OBVIO xD)
        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/articulos", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "observacion" => null,
            "tipo_articulo_talle_id" => $tipoArticuloTalle->id,
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
        ]);
        
        $this->assertDatabaseHas('articulo', [
            "id" => $response['id'],
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
            "tipo_articulo_talle_id" => $tipoArticuloTalle->id
        ]);
    }
}
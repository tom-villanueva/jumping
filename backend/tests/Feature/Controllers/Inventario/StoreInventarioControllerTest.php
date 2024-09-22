<?php

namespace Tests\Feature;

use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talle;
use App\Models\TipoArticulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreInventarioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_inventario()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'tipo_articulo_id' => 25,
            'talle_id' => 25,
			'marca_id' => 25,
            'modelo_id' => 25,
            'stock' => 0
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/inventarios', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'tipo_articulo_id', 
            'talle_id', 
            'marca_id',
            'modelo_id'
        ]);
    }

	public function test_unauthorized_user_cannot_store_inventario()
	{
		$response = $this->postJson('/api/inventarios', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_inventario()
    {
        $user = $this->createStubUser();

        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca =  Marca::factory()->create();
        $modelo =  Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $data = [
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'stock' => 0
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/inventarios", $data);

        $response->assertStatus(201);
        $response->assertJson([
            'talle_id' => $data["talle_id"],
            'tipo_articulo_id' => $data["tipo_articulo_id"],
            'marca_id' => $data["marca_id"],
            'modelo_id' => $data["modelo_id"],
            'stock' => $data["stock"]
        ]);
        
        $this->assertDatabaseHas('inventario', [
            "id" => $response['id'],
        ]);
    }
}
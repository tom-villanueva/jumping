<?php

namespace Tests\Feature;

use App\Models\Marca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreModeloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_modelo()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'descripcion' => '',
            'marca_id' => 12
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/modelos', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'descripcion', 'marca_id' ]);
    }

	public function test_unauthorized_user_cannot_store_modelo()
	{
		$response = $this->postJson('/api/modelos', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_modelo()
    {
        $user = $this->createStubUser();

        $data = [
            'descripcion' => 'hola test',
            'marca_id' => Marca::factory()->create()->id
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/modelos", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "descripcion" => $data['descripcion'],
            "marca_id" => $data['marca_id']
        ]);
        
        $this->assertDatabaseHas('modelo', [
            "id" => $response['id'],
        ]);
    }
}
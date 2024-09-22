<?php

namespace Tests\Feature;

use App\Models\Marca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateMarcaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_marca_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $marca = Marca::factory()->create();
        $marca2 = Marca::factory()->create();

        $data = [
            // ejemplo unique descripcion
            'descripcion' => $marca->descripcion,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/marcas/{$marca2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['descripcion']);
    }

    public function test_unauthorized_user_can_not_update_marca()
    {
        $marca = Marca::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/marcas/{$marca->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_marca()
    {
        $user = $this->createStubUser();

        $marca = Marca::factory()->create();

        $data = [
            'descripcion' => 'Nueva desc',
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/marcas/{$marca->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'descripcion' => $data['descripcion']
        ]);
        
        $this->assertDatabaseHas('marca', [
            "id" => $response['id'],
        ]);
    }
}
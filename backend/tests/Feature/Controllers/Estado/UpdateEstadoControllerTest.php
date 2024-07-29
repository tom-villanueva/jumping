<?php

namespace Tests\Feature;

use App\Models\Estado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateEstadoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_estado_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $estado = Estado::factory()->create();
        $estado2 = Estado::factory()->create();

        $data = [
            // ejemplo unique descripcion
            'descripcion' => $estado->descripcion,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/estados/{$estado2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['descripcion']);
    }

    public function test_unauthorized_user_can_not_update_estado()
    {
        $estado = Estado::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/estados/{$estado->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_estado()
    {
        $user = $this->createStubUser();

        $estado = Estado::factory()->create();

        $data = [
            'descripcion' => 'prueba'
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/estados/{$estado->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'descripcion' => $data['descripcion']
        ]);
        
        $this->assertDatabaseHas('estados', [
            "id" => $response['id'],
        ]);
    }
}
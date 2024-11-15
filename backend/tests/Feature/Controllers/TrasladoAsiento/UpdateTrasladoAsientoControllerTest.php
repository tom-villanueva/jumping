<?php

namespace Tests\Feature;

use App\Models\TrasladoAsiento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateTrasladoAsientoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_traslado_asiento_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $traslado_asiento = TrasladoAsiento::factory()->create();
        $traslado_asiento2 = TrasladoAsiento::factory()->create();

        $data = [
            // ejemplo unique descripcion
            'descripcion' => $traslado_asiento->descripcion,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/traslado_asientos/{$traslado_asiento2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['descripcion']);
    }

    public function test_unauthorized_user_can_not_update_traslado_asiento()
    {
        $traslado_asiento = TrasladoAsiento::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/traslado_asientos/{$traslado_asiento->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_traslado_asiento()
    {
        $user = $this->createStubUser();

        $traslado_asiento = TrasladoAsiento::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/traslado_asientos/{$traslado_asiento->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            /* rellenar */
        ]);
        
        $this->assertDatabaseHas('traslado_asientos', [
            "id" => $response['id'],
        ]);
    }
}
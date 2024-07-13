<?php

namespace Tests\Feature;

use App\Models\Traslado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateTrasladoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_traslado_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $traslado = Traslado::factory()->create();
        $traslado2 = Traslado::factory()->create();

        $data = [
            // ejemplo unique descripcion
            'descripcion' => $traslado->descripcion,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/traslados/{$traslado2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['descripcion']);
    }

    public function test_unauthorized_user_can_not_update_traslado()
    {
        $traslado = Traslado::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/traslados/{$traslado->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_traslado()
    {
        $user = $this->createStubUser();

        $traslado = Traslado::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/traslados/{$traslado->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            /* rellenar */
        ]);
        
        $this->assertDatabaseHas('traslados', [
            "id" => $response['id'],
        ]);
    }
}
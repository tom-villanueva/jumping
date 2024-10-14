<?php

namespace Tests\Feature;

use App\Models\TrasladoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateTrasladoPrecioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_traslado_precio_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $traslado_precio = TrasladoPrecio::factory()->create();
        $traslado_precio2 = TrasladoPrecio::factory()->create();

        $data = [
            // ejemplo unique descripcion
            'descripcion' => $traslado_precio->descripcion,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/traslado_precios/{$traslado_precio2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['descripcion']);
    }

    public function test_unauthorized_user_can_not_update_traslado_precio()
    {
        $traslado_precio = TrasladoPrecio::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/traslado_precios/{$traslado_precio->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_traslado_precio()
    {
        $user = $this->createStubUser();

        $traslado_precio = TrasladoPrecio::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/traslado_precios/{$traslado_precio->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            /* rellenar */
        ]);
        
        $this->assertDatabaseHas('traslado_precios', [
            "id" => $response['id'],
        ]);
    }
}
<?php

namespace Tests\Feature;

use App\Models\EquipoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateEquipoPrecioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_equipo_precio_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $equipo_precio = EquipoPrecio::factory()->create();
        $equipo_precio2 = EquipoPrecio::factory()->create();

        $data = [
            // ejemplo unique descripcion
            'descripcion' => $equipo_precio->descripcion,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/equipo_precios/{$equipo_precio2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['descripcion']);
    }

    public function test_unauthorized_user_can_not_update_equipo_precio()
    {
        $equipo_precio = EquipoPrecio::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/equipo_precios/{$equipo_precio->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_equipo_precio()
    {
        $user = $this->createStubUser();

        $equipo_precio = EquipoPrecio::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/equipo_precios/{$equipo_precio->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            /* rellenar */
        ]);
        
        $this->assertDatabaseHas('equipo_precios', [
            "id" => $response['id'],
        ]);
    }
}
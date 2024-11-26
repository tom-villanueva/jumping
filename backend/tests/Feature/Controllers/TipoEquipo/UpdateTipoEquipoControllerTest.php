<?php

namespace Tests\Feature;

use App\Models\TipoEquipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateTipoEquipoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_tipo_equipo_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $tipo_equipo = TipoEquipo::factory()->create();
        $tipo_equipo2 = TipoEquipo::factory()->create();

        $data = [
            // ejemplo unique descripcion
            'descripcion' => null,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/tipo-equipos/{$tipo_equipo2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['descripcion']);
    }

    public function test_unauthorized_user_can_not_update_tipo_equipo()
    {
        $tipo_equipo = TipoEquipo::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/tipo-equipos/{$tipo_equipo->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_tipo_equipo()
    {
        $user = $this->createStubUser();

        $tipo_equipo = TipoEquipo::factory()->create();

        $data = [
            'descripcion' => 'nueva desc'
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/tipo-equipos/{$tipo_equipo->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'descripcion' => $data['descripcion']
        ]);
        
        $this->assertDatabaseHas('tipo_equipos', [
            "id" => $response['id'],
        ]);
    }
}
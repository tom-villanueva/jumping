<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateClienteControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_cliente_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $cliente = Cliente::factory()->create();
        $cliente2 = Cliente::factory()->create();

        $data = [
            // ejemplo unique descripcion
            'email' => $cliente->descripcion,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/clientes/{$cliente2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_unauthorized_user_can_not_update_cliente()
    {
        $cliente = Cliente::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/clientes/{$cliente->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_cliente()
    {
        $user = $this->createStubUser();

        $cliente = Cliente::factory()->create();

        $userC = User::factory()->create();

        $data = [
            'nombre' => 'juan', 
            'apellido' => 'perez', 
            'email' => $cliente->email,
            'telefono' => '2929029',
            'tipo_persona_id' => 1,
            'user_id' => $userC->id,
            'fecha_nacimiento' => '',
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/clientes/{$cliente->id}", $data);
        
        $response->assertStatus(200);
        $response->assertJson([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'tipo_persona_id' => $data['tipo_persona_id'],
            'user_id' => $data['user_id'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
        ]);
        
        $this->assertDatabaseHas('clientes', [
            "id" => $response['id'],
        ]);
    }
}
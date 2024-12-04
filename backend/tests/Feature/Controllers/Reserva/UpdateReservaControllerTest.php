<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateReservaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_reserva_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $reserva = Reserva::factory()->create();

        $data = [
            'comentario' => fake()->words(256, true),
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/reservas/{$reserva->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['comentario']);
    }

    public function test_unauthorized_user_can_not_update_reserva()
    {
        $reserva = Reserva::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/reservas/{$reserva->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_reserva()
    {
        $user = $this->createStubUser();

        $reserva = Reserva::factory()->create();

        $cliente = Cliente::find($reserva->cliente_id);

        $data = [
            'comentario' => "nuevo comment",
            'nombre' => 'juan',
            'apellido' => 'perez',
            'email' => 'nuevo@gmail.com',
            'telefono' => 2901,
            'fecha_nacimiento' => '2000-09-02',
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/reservas/{$reserva->id}", $data);
        
        $response->assertStatus(200);
        $response->assertJson([
            'comentario' => $data['comentario'],
        ]);
        
        $this->assertDatabaseHas('reservas', [
            "id" => $response['id'],
        ]);

        $this->assertDatabaseHas('clientes', [
            "id" => $response['cliente_id'],
            "nombre" => $data['nombre'],
            "apellido" => $data['apellido'],
            "email" => $data['email'],
            "telefono" => $data['telefono'],
            "fecha_nacimiento" => $data['fecha_nacimiento']
        ]);
    }
}
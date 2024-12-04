<?php

namespace Tests\Feature;

use App\Models\Estado;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreReservaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_reserva()
    {
        // Arrange
		$user = $this->createStubUser();

        $today = Carbon::now()->format('Y-m-d');
        $todaySubOneDay = Carbon::now()->subDay()->format('Y-m-d');

        $data = [
            'fecha_desde' => $today,
            'fecha_hasta' => $todaySubOneDay,
            'comentario' => null,
            'cliente_id' => null,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/reservas', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'fecha_hasta', 'nombre', 'apellido', 'email' ]);
    }

	public function test_unauthorized_user_cannot_store_reserva()
	{
		$response = $this->postJson('/api/reservas', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_reserva()
    {
        $user = $this->createStubUser();

        $today = Carbon::now()->format('Y-m-d');
        $todayPlusOneDay = Carbon::now()->addDay()->format('Y-m-d');

        // $estado = Estado::factory()->create();

        $data = [
            'fecha_prueba' => $today,
            'fecha_desde' => $today,
            'fecha_hasta' => $todayPlusOneDay,
            'comentario' => "soy un comentario",
            'cliente_id' => null,
            'nombre' => 'tomas',
            'apellido' => 'villanueva',
            'email' => 'tomi@gmail.com',
            'telefono' => null,
            'fecha_nacimiento' => null
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/reservas", $data);
        
        $response->assertStatus(201);
        $response->assertJson([
            'fecha_prueba' => $data['fecha_prueba'],
            'fecha_desde' => $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'comentario' => $data['comentario'],
        ]);

        $this->assertDatabaseHas('clientes', [
            "id" => $response['cliente_id'], 
        ]);
        
        $this->assertDatabaseHas('reservas', [
            "id" => $response['id'], 
        ]);

        $this->assertDatabaseHas('reserva_estado', [
            "reserva_id" => $response['id'],
            "estado_id" => 1
        ]);
    }
}
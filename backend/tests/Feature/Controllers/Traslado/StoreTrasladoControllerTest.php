<?php

namespace Tests\Feature;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreTrasladoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_traslado()
    {
        // Arrange
		$user = $this->createStubUser();

        $today = Carbon::now()->format('Y-m-d');
        $todaySubOneDay = Carbon::now()->subDay()->format('Y-m-d');

        $data = [
            'direccion' => 'prueba',
            'fecha_desde' => $today,
            'fecha_hasta' => $todaySubOneDay,
            'reserva_id' => 11
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/traslados', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'fecha_hasta', 'reserva_id' ]);
    }

	public function test_unauthorized_user_cannot_store_traslado()
	{
		$response = $this->postJson('/api/traslados', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_traslado()
    {
        $user = $this->createStubUser();

        $today = Carbon::now()->format('Y-m-d');
        $todayPlusOneDay = Carbon::now()->addDay()->format('Y-m-d');

        $data = [
            'direccion' => 'prueba',
            'fecha_desde' => $today,
            'fecha_hasta' => $todayPlusOneDay,
            'reserva_id' => Reserva::factory()->create()->id
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/traslados", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "direccion" => $data['direccion'],
            "fecha_desde" => $data['fecha_desde'],
            "fecha_hasta" => $data['fecha_hasta'],
            "reserva_id" => $data['reserva_id'],
        ]);
        
        $this->assertDatabaseHas('traslados', [
            "id" => $response['id'],
        ]);
    }
}
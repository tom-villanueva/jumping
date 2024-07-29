<?php

namespace Tests\Feature;

use App\Models\Traslado;
use Carbon\Carbon;
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

        $today = Carbon::now()->format('Y-m-d');
        $todaySubOneDay = Carbon::now()->subDay()->format('Y-m-d');

        $data = [
            'direccion' => 'prueba',
            'fecha_desde' => $today,
            'fecha_hasta' => $todaySubOneDay,
            'reserva_id' => 11
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/traslados/{$traslado->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['fecha_hasta', 'reserva_id']);
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
            'direccion' => 'nueva direccion',
            'fecha_desde' => $traslado->fecha_desde,
            'fecha_hasta' => $traslado->fecha_hasta,
            'reserva_id' => $traslado->reserva_id
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/traslados/{$traslado->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'direccion' => $data['direccion']
        ]);
        
        $this->assertDatabaseHas('traslados', [
            "id" => $response['id'],
        ]);
    }
}
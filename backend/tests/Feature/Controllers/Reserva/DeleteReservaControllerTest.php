<?php

namespace Tests\Feature;

use App\Models\Reserva;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteReservaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_reserva()
    {
        $reserva = Reserva::factory()->create();

        $response = $this->deleteJson("/api/reservas/{$reserva->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_reserva()
    {
        $user = $this->createStubUser();

        $reserva = Reserva::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/reservas/{$reserva->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('reservas', [
            'id' => $reserva->id,
        ]);
    }
}
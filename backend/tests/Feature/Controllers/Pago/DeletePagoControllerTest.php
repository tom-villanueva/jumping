<?php

namespace Tests\Feature;

use App\Models\Pago;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeletePagoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_pago()
    {
        $pago = Pago::factory()->create();

        $response = $this->deleteJson("/api/pagos/{$pago->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_pago()
    {
        $user = $this->createStubUser();

        $pago = Pago::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/pagos/{$pago->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('pagos', [
            'id' => $pago->id,
        ]);
    }
}
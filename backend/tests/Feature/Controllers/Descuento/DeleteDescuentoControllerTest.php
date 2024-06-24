<?php

namespace Tests\Feature;

use App\Models\Descuento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteDescuentoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_descuento()
    {
        $descuento = Descuento::factory()->create();

        $response = $this->deleteJson("/api/descuentos/{$descuento->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_descuento()
    {
        $user = $this->createStubUser();

        $descuento = Descuento::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/descuentos/{$descuento->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('descuentos', [
            'id' => $descuento->id,
        ]);
    }
}
<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteClienteControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_cliente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->deleteJson("/api/clientes/{$cliente->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_cliente()
    {
        $user = $this->createStubUser();

        $cliente = Cliente::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/clientes/{$cliente->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('clientes', [
            'id' => $cliente->id,
        ]);
    }
}
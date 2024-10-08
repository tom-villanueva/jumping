<?php

namespace Tests\Feature;

use App\Models\Pago;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetPagoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_pagos()
    {
        Pago::factory()->count(3)->create();

        $response = $this->getJson('api/pagos');

        $response->assertStatus(401);
    }

    public function test_user_can_get_pagos()
    {
        Pago::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/pagos');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_pago_by_id()
    {
        $pago = Pago::factory()->create();

        $response = $this->getJson("api/pagos/{$pago->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_pago_by_id()
    {
        $pago = Pago::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/pagos/{$pago->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $pago->id,
        ]);
    }
}
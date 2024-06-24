<?php

namespace Tests\Feature;

use App\Models\Descuento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetDescuentoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_descuentos()
    {
        Descuento::factory()->count(3)->create();

        $response = $this->getJson('api/descuentos');

        $response->assertStatus(401);
    }

    public function test_user_can_get_descuentos()
    {
        Descuento::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/descuentos');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_descuento_by_id()
    {
        $descuento = Descuento::factory()->create();

        $response = $this->getJson("api/descuentos/{$descuento->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_descuento_by_id()
    {
        $descuento = Descuento::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/descuentos/{$descuento->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $descuento->id,
        ]);
    }
}
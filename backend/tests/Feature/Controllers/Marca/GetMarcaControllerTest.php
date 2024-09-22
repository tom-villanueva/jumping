<?php

namespace Tests\Feature;

use App\Models\Marca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetMarcaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_marcas()
    {
        Marca::factory()->count(3)->create();

        $response = $this->getJson('api/marcas');

        $response->assertStatus(401);
    }

    public function test_user_can_get_marcas()
    {
        Marca::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/marcas');

        $response->assertStatus(200);
        $response->assertJsonCount(5); // ya hay dos por el seeder
    }

    public function test_unauthorized_user_cannot_get_marca_by_id()
    {
        $marca = Marca::factory()->create();

        $response = $this->getJson("api/marcas/{$marca->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_marca_by_id()
    {
        $marca = Marca::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/marcas/{$marca->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $marca->id,
        ]);
    }
}
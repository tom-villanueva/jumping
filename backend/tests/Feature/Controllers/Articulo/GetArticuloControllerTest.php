<?php

namespace Tests\Feature;

use App\Models\Articulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetArticuloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_articulos()
    {
        Articulo::factory()->count(3)->create();

        $response = $this->getJson('api/articulos');

        $response->assertStatus(401);
    }

    public function test_user_can_get_articulos()
    {
        Articulo::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/articulos');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_articulo_by_id()
    {
        $articulo = Articulo::factory()->create();

        $response = $this->getJson("api/articulos/{$articulo->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_articulo_by_id()
    {
        $articulo = Articulo::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/articulos/{$articulo->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $articulo->id,
            'codigo' => $articulo->codigo,
            'descripcion' => $articulo->descripcion
        ]);
    }
}
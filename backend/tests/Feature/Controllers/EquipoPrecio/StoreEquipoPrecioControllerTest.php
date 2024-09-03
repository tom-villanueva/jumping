<?php

namespace Tests\Feature;

use App\Models\Equipo;
use App\Models\EquipoPrecio;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreEquipoPrecioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_equipo_precio()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'equipo_id' => 12,
            'precio' => -10,
            'fecha_desde' => Carbon::now()->subDays(2)->format('Y-m-d'),
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/equipo-precios', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'equipo_id', 'precio', 'fecha_desde' ]);
    }

	public function test_unauthorized_user_cannot_store_equipo_precio()
	{
		$response = $this->postJson('/api/equipo-precios', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_equipo_precio()
    {
        $user = $this->createStubUser();

        $equipo = Equipo::factory()->create();

        $equipoPrecio = EquipoPrecio::factory()->create([
            "equipo_id" => $equipo->id
        ]);

        $fechaDesde = Carbon::now()->addDay(10);

        $data = [
            'equipo_id' => $equipo->id,
            'precio' => 100,
            'fecha_desde' => $fechaDesde->format('Y-m-d'),
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/equipo-precios", $data);

        // assert equipo precio anterior tiene la fecha correcta
        // un día anterior a fecha_desde del nuevo
        $this->assertDatabaseHas('equipo_precio', [
            "id" => $equipoPrecio->id,
            "fecha_hasta" => Carbon::now()->addDay(9)->format('Y-m-d')
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            "id" => $response['id'],
            "fecha_desde" => $fechaDesde->format('Y-m-d'),
            "fecha_hasta" => null
        ]);
        
        $this->assertDatabaseHas('equipo_precio', [
            "id" => $response['id'],
        ]);
    }
}
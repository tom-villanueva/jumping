<?php

namespace Tests\Feature;

use App\Models\Descuento;
use App\Models\Equipo;
use App\Models\EquipoDescuento;
use App\Models\EquipoPrecio;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreReservaEquipoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_reserva_equipo()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'altura' => 'perro',
            'reserva_id' => 10,
            'equipo_id' => 10
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/reserva-equipos', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'reserva_id', 'equipo_id', 'altura' ]);
    }

	public function test_unauthorized_user_cannot_store_reserva_equipo()
	{
		$response = $this->postJson('/api/reserva-equipos', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_reserva_equipo()
    {
        $user = $this->createStubUser();

        $equipo = Equipo::factory()->create();
        $descuento = Descuento::factory()->create();

        $equipo_descuento = EquipoDescuento::factory()->create([
            'equipo_id' => $equipo->id,
            'descuento_id' => $descuento->id
        ]);
        $equipo_descuento2 = EquipoDescuento::factory()->create([
            'equipo_id' => $equipo->id,
            'descuento_id' => $descuento->id,
            'fecha_desde' => Carbon::now()->addDays(10)->format('Y-m-d'),
            'fecha_hasta' => Carbon::now()->addDays(15)->format('Y-m-d')
        ]);

        $equipo_precio = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id
        ]);
        $equipo_precio2 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'created_at' => Carbon::now()->addDay() // más nuevo
        ]);

        $data = [
            'altura' => 178,
            'peso' => 86,
            'num_calzado' => 42,
            'nombre' => "Tom",
            'apellido' => "Villanueva",
            'reserva_id' => Reserva::factory()->create()->id,
            'equipo_id' => $equipo->id
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/reserva-equipos", $data);
        
        $response->assertStatus(201);
        $response->assertJson([
            "reserva_id" => $data['reserva_id'],
            "equipo_id" => $data['equipo_id'],
            "altura" => $data['altura'],
            "peso" => $data['peso'],
            "num_calzado" => $data['num_calzado'],
            "nombre" => $data['nombre'],
            "apellido" => $data['apellido'],
            "equipo_precio_id" => $equipo_precio2->id,
            "equipo_descuento_id" => $equipo_descuento->id
        ]);
        
        $this->assertDatabaseHas('reserva_equipo', [
            "id" => $response['id'],
        ]);
    }
}
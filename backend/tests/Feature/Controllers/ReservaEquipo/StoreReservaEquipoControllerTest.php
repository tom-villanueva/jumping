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
         // Create stub user
        $user = $this->createStubUser();

        // Create Reserva and Equipo
        $reserva = Reserva::factory()->create([
            'fecha_desde' => Carbon::now()->format('Y-m-d'),
            'fecha_hasta' => Carbon::now()->addDays(5)->format('Y-m-d')
        ]);

        $equipo = Equipo::factory()->create();

        // Create overlapping EquipoPrecio and EquipoDescuento
        $precio0 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => Carbon::now()->subDays(10),
            'fecha_hasta' => Carbon::now()->subDays(2)
        ]);

        $precio1 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => Carbon::now()->subDays(1),
            'fecha_hasta' => Carbon::now()->addDays(2)
        ]);

        $precio2 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => Carbon::now()->addDays(3),
            'fecha_hasta' => null
        ]);

        $descuento0 = EquipoDescuento::factory()->create([
            'equipo_id' => $equipo->id,
            'dias' => 6
            // 'fecha_desde' => Carbon::now()->subDays(10),
            // 'fecha_hasta' => Carbon::now()->subDays(1)
        ]);

        // $descuento1 = EquipoDescuento::factory()->create([
        //     'equipo_id' => $equipo->id,
        //     'fecha_desde' => Carbon::now()->subDay(),
        //     'fecha_hasta' => Carbon::now()->addDays(2)
        // ]);

        // $descuento2 = EquipoDescuento::factory()->create([
        //     'equipo_id' => $equipo->id,
        //     'fecha_desde' => Carbon::now()->addDays(3),
        //     'fecha_hasta' => Carbon::now()->addDays(10)
        // ]);

        // Prepare request data
        $data = [
            'altura' => 178,
            'peso' => 86,
            'num_calzado' => 42,
            'nombre' => "Tom",
            'apellido' => "Villanueva",
            'reserva_id' => $reserva->id,
            'equipo_id' => $equipo->id
        ];

        // Perform the request
        $response = $this->actingAs($user, $user->getModelGuard())
            ->postJson("/api/reserva-equipos", $data);
// dd($response);
        $response->assertStatus(201);
        $response->assertJson([
            'reserva_id' => $reserva->id,
            'equipo_id' => $equipo->id,
        ]);

        // Assert that the ReservaEquipo is created
        $this->assertDatabaseHas('reserva_equipo', [
            'id' => $response['id'],
            'reserva_id' => $reserva->id,
            'equipo_id' => $equipo->id
        ]);

        // Assert that the correct ReservaEquipoPrecio records are created
        $this->assertDatabaseHas('reserva_equipo_precio', [
            'reserva_equipo_id' => $response['id'],
            'equipo_precio_id' => $precio1->id,
            'precio' => $precio1->precio,
            'fecha_desde' => $precio1->fecha_desde,
            'fecha_hasta' => $precio1->fecha_hasta
        ]);
        $this->assertDatabaseHas('reserva_equipo_precio', [
            'reserva_equipo_id' => $response['id'],
            'equipo_precio_id' => $precio2->id,
            'precio' => $precio2->precio,
            'fecha_desde' => $precio2->fecha_desde,
            'fecha_hasta' => $reserva->fecha_hasta
        ]);

        // Assert that the correct ReservaEquipoDescuento recordD is created
        $this->assertDatabaseHas('reserva_equipo_descuento', [
            'reserva_equipo_id' => $response['id'],
            'equipo_descuento_id' => $descuento0->id,
            'descuento' => $descuento0->descuento->valor,
            'dias' => $descuento0->dias
            // 'fecha_desde' => $descuento1->fecha_desde,
            // 'fecha_hasta' => $descuento1->fecha_hasta
        ]);
        // $this->assertDatabaseHas('reserva_equipo_descuento', [
        //     'reserva_equipo_id' => $response['id'],
        //     'equipo_descuento_id' => $descuento2->id,
        //     'descuento' => $descuento2->descuento->valor,
        //     'fecha_desde' => $descuento2->fecha_desde,
        //     'fecha_hasta' => $descuento2->fecha_hasta
        // ]);
    }
}
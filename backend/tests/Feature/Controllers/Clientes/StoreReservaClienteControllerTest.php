<?php

namespace Tests\Feature;

use App\Models\Descuento;
use App\Models\Equipo;
use App\Models\EquipoDescuento;
use App\Models\EquipoPrecio;
use App\Models\Estado;
use App\Models\ReservaEquipo;
use App\Models\TrasladoPrecio;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreReservaClienteControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    /** @test */
    public function test_store_reserva_creates_reserva_and_related_data()
    {
        $equipos = Equipo::factory()->count(2)->create();

        // Date range in the allowed months (June - September)
        $fechaDesde = '2025-06-15'; // June 15, 2024
        $fechaHasta = '2025-06-20'; // September 10, 2024

        EquipoPrecio::factory()->create([
            'equipo_id' => 1,
            'fecha_desde' => $fechaDesde,
            'fecha_hasta' => $fechaHasta
        ]);

        EquipoPrecio::factory()->create([
            'equipo_id' => 2,
            'fecha_desde' => $fechaDesde,
            'fecha_hasta' => $fechaHasta
        ]);

        Descuento::factory()->create();

        Estado::factory()->create();

        EquipoDescuento::factory()->create([
            'equipo_id' => 1,
            'dias' => 6
        ]);

        // Create traslado prices
        $trasladoPrecio = TrasladoPrecio::factory()->create([
            'precio' => 1000,
            'fecha_desde' => $fechaDesde,
            'fecha_hasta' => $fechaHasta,
        ]);

        // Prepare request payload
        $payload = [
            'fecha_desde' => $fechaDesde,
            'fecha_hasta' => $fechaHasta,
            'user_id' => null,
            'apellido' => 'Doe',
            'email' => 'tomas.villanueva.jousset@gmail.com',
            'equipos' => $equipos->map(function ($equipo) {
                return [
                    'nombre' => 'Nombre Equipo',
                    'apellido' => 'Apellido Equipo',
                    'equipo_id' => $equipo->id,
                ];
            })->toArray(),
            'traslados' => [
                [
                    'direccion' => 'Direccion 1',
                    'fecha_desde' => $fechaDesde,
                    'fecha_hasta' => $fechaHasta,
                ]
            ]
        ];

        // Call the controller method
        $response = $this->postJson("/api/clientes/reserva", $payload);
        
        //dd($response);
        // Assert response
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id', 'fecha_desde', 'fecha_hasta', 'user_id'
        ]);

        // Assert reserva and related data in the database
        $this->assertDatabaseHas('reservas', [
            'id' => $response->json('id'),
            'fecha_desde' => $fechaDesde,
            'fecha_hasta' => $fechaHasta,
            'user_id' => null,
        ]);

        $this->assertDatabaseHas('reserva_estado', [
            'reserva_id' => $response->json('id'),
            'estado_id' => 1,
        ]);

        foreach ($payload['equipos'] as $equipo) {
            $reservaEquipo = ReservaEquipo::where('reserva_id', $response->json('id'))
                ->where('equipo_id', $equipo['equipo_id'])
                ->first();
                
            $this->assertNotNull($reservaEquipo);

            $this->assertDatabaseHas('reserva_equipo_precio', [
                'reserva_equipo_id' => $reservaEquipo->id,
            ]);

            if($equipo["equipo_id"] == 1) {
                $this->assertDatabaseHas('reserva_equipo_descuento', [
                    'reserva_equipo_id' => $reservaEquipo->id,
                ]);
            }
        }

        foreach ($payload['traslados'] as $traslado) {
            $this->assertDatabaseHas('traslados', [
                'direccion' => $traslado['direccion'],
                'fecha_desde' => $traslado['fecha_desde'],
                'fecha_hasta' => $traslado['fecha_hasta'],
            ]);
        }
    }
}
<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Descuento;
use App\Models\Equipo;
use App\Models\EquipoDescuento;
use App\Models\EquipoPrecio;
use App\Models\Estado;
use App\Models\ReservaEquipo;
use App\Models\TrasladoPrecio;
use App\Models\User;
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
            'nombre' => 'John',
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
            'id', 'fecha_desde', 'fecha_hasta'
        ]);

        // Assert reserva and related data in the database
        $this->assertDatabaseHas('reservas', [
            'id' => $response->json('id'),
            'fecha_desde' => $fechaDesde,
            'fecha_hasta' => $fechaHasta,
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

    private function preparePayload($equipos, $fechaDesde, $fechaHasta, $overrides = [])
    {
        return array_merge([
            'fecha_desde' => $fechaDesde,
            'fecha_hasta' => $fechaHasta,
            'user_id' => null,
            'nombre' => 'John',
            'apellido' => 'Doe',
            'email' => 'tomas.villanueva.jousset@gmail.com',
            'equipos' => $equipos->map(fn ($equipo) => [
                'nombre' => 'Nombre Equipo',
                'apellido' => 'Apellido Equipo',
                'equipo_id' => $equipo->id,
            ])->toArray(),
            'traslados' => [[
                'direccion' => 'Direccion 1',
                'fecha_desde' => $fechaDesde,
                'fecha_hasta' => $fechaHasta,
            ]]
        ], $overrides);
    }

    /** @test */
    public function it_creates_a_new_client_and_user()
    {
        $equipos = Equipo::factory()->count(2)->create();
        $fechaDesde = '2025-06-15';
        $fechaHasta = '2025-06-20';

        EquipoPrecio::factory()->count(2)->create([
            'fecha_desde' => $fechaDesde,
            'fecha_hasta' => $fechaHasta,
        ]);

        $payload = $this->preparePayload($equipos, $fechaDesde, $fechaHasta, [
            'crear_user' => true
        ]);

        $response = $this->postJson('/api/clientes/reserva', $payload);

        $response->assertStatus(201);

        $this->assertDatabaseHas('clientes', [
            'email' => $payload['email'],
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $payload['email'],
        ]);
    }

    /** @test */
    public function it_uses_existing_client_with_no_user_and_creates_user()
    {
        $cliente = Cliente::factory()->create(['email' => 'tomas.villanueva.jousset@gmail.com']);
        $equipos = Equipo::factory()->count(2)->create();
        $fechaDesde = '2025-06-15';
        $fechaHasta = '2025-06-20';

        $payload = $this->preparePayload($equipos, $fechaDesde, $fechaHasta, [
            'crear_user' => true
        ]);

        $response = $this->postJson('/api/clientes/reserva', $payload);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'email' => $cliente->email,
        ]);
    }

    /** @test */
    public function it_uses_existing_client_with_user()
    {
        $user = User::factory()->create(['email' => 'tomas.villanueva.jousset@gmail.com']);
        $cliente = Cliente::factory()->create(['email' => $user->email, 'user_id' => $user->id]);
        $equipos = Equipo::factory()->count(2)->create();
        $fechaDesde = '2025-06-15';
        $fechaHasta = '2025-06-20';

        $payload = $this->preparePayload($equipos, $fechaDesde, $fechaHasta, [
            'user_id' => $user->id
        ]);

        $response = $this->postJson('/api/clientes/reserva', $payload);

        $response->assertStatus(201);

        $this->assertDatabaseHas('clientes', [
            'email' => $user->email,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_creates_a_new_client_without_user()
    {
        $equipos = Equipo::factory()->count(2)->create();
        $fechaDesde = '2025-06-15';
        $fechaHasta = '2025-06-20';

        $payload = $this->preparePayload($equipos, $fechaDesde, $fechaHasta);

        $response = $this->postJson('/api/clientes/reserva', $payload);

        $response->assertStatus(201);

        $this->assertDatabaseHas('clientes', [
            'email' => $payload['email'],
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => $payload['email'],
        ]);
    }
}
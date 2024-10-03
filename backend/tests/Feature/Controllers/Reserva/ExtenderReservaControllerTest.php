<?php

namespace Tests\Feature;

use App\Models\Articulo;
use App\Models\Equipo;
use App\Models\Reserva;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoArticulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class ExtenderReservaControllerTest extends TestCase
{
    use RefreshDatabase, WithStubUserEmpleado;

    /** @test */
    public function it_extends_a_reservation_and_creates_new_reserva_with_equipos()
    {
        $user = $this->createStubUser();
        // Create an existing reserva to be extended
        $existingReserva = Reserva::factory()->create();

        // Create equipos and reserva equipo relationships
        $equipos = Equipo::factory()->count(2)->create();
        $reservaEquipos = $equipos->map(function ($equipo) use ($existingReserva) {
            return ReservaEquipo::factory()->create([
                'reserva_id' => $existingReserva->id,
                'equipo_id' => $equipo->id,
            ]);
        });

        // Create articles (articulos) associated with reserva equipos
        $articulos = $reservaEquipos->map(function ($reservaEquipo) {
            return ReservaEquipoArticulo::factory()->create([
                'reserva_equipo_id' => $reservaEquipo->id,
                'articulo_id' => Articulo::factory()->create()->id,
                'devuelto' => false,
            ]);
        });

        // Simulate the request data for extending the reservation
        $requestData = [
            'fecha_desde' => now()->addDays(1)->format('Y-m-d'),
            'fecha_hasta' => now()->addDays(5)->format('Y-m-d'),
            'reserva_equipo_ids' => $reservaEquipos->map(function ($reservaEquipo) {
                return ['reserva_equipo_id' => $reservaEquipo->id];
            })->toArray(),
            'es_extension' => true, // Mark as extension
        ];

        // Act: Call the controller's invoke method
        $response = $this->actingAs(
            $user,
            $user->getModelGuard()
        )->postJson("/api/reservas/extender/{$existingReserva->id}", $requestData);

        // Assert: Check if the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert: Check if the new reservation is created and returned in the response
        $newReservaId = $response->json('id');
        $this->assertNotNull($newReservaId);
        $this->assertDatabaseHas('reservas', ['id' => $newReservaId]);

        // Check that the new reservation has the same user info as the old one
        $this->assertDatabaseHas('reservas', [
            'id' => $newReservaId,
            'nombre' => $existingReserva->nombre,
            'apellido' => $existingReserva->apellido,
            'email' => $existingReserva->email,
        ]);

        // Assert that the new reservation contains the new ReservaEquipo records
        foreach ($reservaEquipos as $oldReservaEquipo) {
            $this->assertDatabaseHas('reserva_equipo', [
                'reserva_id' => $newReservaId,
                'equipo_id' => $oldReservaEquipo->equipo_id,
            ]);

            // Get the newly created ReservaEquipo based on the new reserva
            $newReservaEquipo = ReservaEquipo::where('reserva_id', $newReservaId)
                ->where('equipo_id', $oldReservaEquipo->equipo_id)
                ->first();

            // Assert that the old articulos have been marked as 'devuelto'
            foreach ($oldReservaEquipo->articulos as $oldArticulo) {
                $this->assertDatabaseHas('reserva_equipo_articulo', [
                    'id' => $oldArticulo->id,
                    'devuelto' => true,
                ]);

                // Assert that the new articulos have been transferred to the new ReservaEquipo
                $this->assertDatabaseHas('reserva_equipo_articulo', [
                    'reserva_equipo_id' => $newReservaEquipo->id,
                    'articulo_id' => $oldArticulo->articulo_id,
                    'devuelto' => false,
                ]);
            }
        }
    }
}
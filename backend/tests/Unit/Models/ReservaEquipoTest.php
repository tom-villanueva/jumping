<?php

namespace Tests\Unit;

use App\Models\Equipo;
use App\Models\Reserva;
use App\Models\ReservaEquipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class ReservaEquipoTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_reserva_equipos_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new ReservaEquipo(), 
            fillable: [
                'altura',
                'peso',
                'num_calzado',
                'nombre',
                'apellido',
                'reserva_id',
                'equipo_id'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'reserva_equipo'
        );
    }

    /* Tests de relaciones */
    public function test_reserva_equipo_reserva_relation_is_ok()
    {
        $reserva_equipo = new ReservaEquipo();
        $reserva = new Reserva();
        $relation = $reserva_equipo->reserva();

        $this->assertBelongsToRelation(
            $relation,
            $reserva_equipo,
            $reserva,
            'reserva_id'
        );
    }

    public function test_reserva_equipo_equipo_relation_is_ok()
    {
        $reserva_equipo = new ReservaEquipo();
        $equipo = new Equipo();
        $relation = $reserva_equipo->equipo();

        $this->assertBelongsToRelation(
            $relation,
            $reserva_equipo,
            $equipo,
            'equipo_id'
        );
    }
}
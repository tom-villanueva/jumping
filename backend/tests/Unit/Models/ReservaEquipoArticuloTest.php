<?php

namespace Tests\Unit;

use App\Models\Articulo;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoArticulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class ReservaEquipoArticuloTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_reserva_equipo_articulos_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new ReservaEquipoArticulo(), 
            fillable: [
                'articulo_id',
                'reserva_equipo_id',
                'devuelto'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'reserva_equipo_articulo'
        );
    }

    /* Tests de relaciones */
    public function test_reserva_equipo_articulo_reserva_equipo_relation_is_ok()
    {
        $reserva_equipo_articulo = new ReservaEquipoArticulo();
        $reserva_equipo = new ReservaEquipo();
        $relation = $reserva_equipo_articulo->reserva_equipo();

        $this->assertBelongsToRelation(
            $relation,
            $reserva_equipo_articulo,
            $reserva_equipo,
            'reserva_equipo_id'
        );
    }

    public function test_reserva_equipo_articulo_articulo_relation_is_ok()
    {
        $reserva_equipo_articulo = new ReservaEquipoArticulo();
        $articulo = new Articulo();
        $relation = $reserva_equipo_articulo->articulo();

        $this->assertBelongsToRelation(
            $relation,
            $reserva_equipo_articulo,
            $articulo,
            'articulo_id'
        );
    }
}
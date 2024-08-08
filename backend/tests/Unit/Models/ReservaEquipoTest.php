<?php

namespace Tests\Unit;

use App\Models\Equipo;
use App\Models\EquipoDescuento;
use App\Models\EquipoPrecio;
use App\Models\Reserva;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoArticulo;
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
                'equipo_id',
                'equipo_precio_id',
                'equipo_descuento_id'
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

    public function test_reserva_reserva_equipo_articulo_relation_is_ok()
    {
        $reserva_equipo = new ReservaEquipo();
        $articulo = new ReservaEquipoArticulo();

        $relation = $reserva_equipo->articulos();

        $this->assertHasManyRelation(
            $relation,
            $reserva_equipo,
            $articulo,
            'reserva_equipo_id'
        );
    }

    public function test_reserva_equipo_equipo_precio_relation_is_ok()
    {
        $reserva_equipo = new ReservaEquipo();
        $equipo_precio = new EquipoPrecio();
        $relation = $reserva_equipo->precio();

        $this->assertBelongsToRelation(
            $relation,
            $reserva_equipo,
            $equipo_precio,
            'equipo_precio_id'
        );
    }

    public function test_reserva_equipo_equipo_descuento_relation_is_ok()
    {
        $reserva_equipo = new ReservaEquipo();
        $equipo_descuento = new EquipoDescuento();
        $relation = $reserva_equipo->descuento();

        $this->assertBelongsToRelation(
            $relation,
            $reserva_equipo,
            $equipo_descuento,
            'equipo_descuento_id'
        );
    }
}
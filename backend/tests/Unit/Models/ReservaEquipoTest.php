<?php

namespace Tests\Unit;

use App\Models\Equipo;
use App\Models\EquipoDescuento;
use App\Models\EquipoPrecio;
use App\Models\Reserva;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoArticulo;
use App\Models\ReservaEquipoDescuento;
use App\Models\ReservaEquipoPrecio;
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
        $equipo_precio = new ReservaEquipoPrecio();
        $relation = $reserva_equipo->precios();

        $this->assertHasManyRelation(
            $relation,
            $reserva_equipo,
            $equipo_precio,
            'reserva_equipo_id'
        );
    }

    public function test_reserva_equipo_equipo_descuento_relation_is_ok()
    {
        $reserva_equipo = new ReservaEquipo();
        $equipo_descuento = new ReservaEquipoDescuento();
        $relation = $reserva_equipo->descuentos();

        $this->assertHasManyRelation(
            $relation,
            $reserva_equipo,
            $equipo_descuento,
            'reserva_equipo_id'
        );
    }
}
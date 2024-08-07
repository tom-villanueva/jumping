<?php

namespace Tests\Unit;

use App\Models\EquipoDescuento;
use App\Models\EquipoPrecio;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoEquipoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class ReservaEquipoEquipoPrecioTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_reserva_equipo_equipo_precios_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new ReservaEquipoEquipoPrecio(), 
            fillable: [
                'reserva_equipo_id',
                'equipo_precio_id',
                'equipo_descuento_id'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'reserva_equipo_equipo_precio'
        );
    }

    /* Tests de relaciones */
    public function test_reserva_equipo_equipo_precio_reserva_equipo_relation_is_ok()
    {
        $reserva_equipo_equipo_precio = new ReservaEquipoEquipoPrecio();
        $reserva_equipo = new ReservaEquipo();
        $relation = $reserva_equipo_equipo_precio->reserva_equipo();

        $this->assertBelongsToRelation(
            $relation,
            $reserva_equipo_equipo_precio,
            $reserva_equipo,
            'reserva_equipo_id'
        );
    }

    public function test_reserva_equipo_equipo_precio_equipo_precio_relation_is_ok()
    {
        $reserva_equipo_equipo_precio = new ReservaEquipoEquipoPrecio();
        $equipo_precio = new EquipoPrecio();
        $relation = $reserva_equipo_equipo_precio->precio();

        $this->assertBelongsToRelation(
            $relation,
            $reserva_equipo_equipo_precio,
            $equipo_precio,
            'equipo_precio_id'
        );
    }

    public function test_reserva_equipo_equipo_precio_equipo_descuento_relation_is_ok()
    {
        $reserva_equipo_equipo_precio = new ReservaEquipoEquipoPrecio();
        $equipo_descuento = new EquipoDescuento();
        $relation = $reserva_equipo_equipo_precio->descuento();

        $this->assertBelongsToRelation(
            $relation,
            $reserva_equipo_equipo_precio,
            $equipo_descuento,
            'equipo_descuento_id'
        );
    }
    
}
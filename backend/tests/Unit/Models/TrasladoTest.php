<?php

namespace Tests\Unit;

use App\Models\Reserva;
use App\Models\Traslado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class TrasladoTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_traslados_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Traslado(), 
            fillable: [
                'direccion',
                'fecha_desde',
                'fecha_hasta',
                'reserva_id'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'traslados'
        );
    }

    /* Tests de relaciones */
    public function test_traslado_reserva_relation_is_ok()
    {
        $traslado = new Traslado();
        $reserva = new Reserva();
        $relation = $traslado->reserva();

        $this->assertBelongsToRelation(
            $relation,
            $traslado,
            $reserva,
            'reserva_id'
        );
    }
}
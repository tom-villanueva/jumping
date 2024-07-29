<?php

namespace Tests\Unit;

use App\Models\Estado;
use App\Models\Reserva;
use App\Models\Traslado;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class ReservaTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_reservas_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Reserva(), 
            fillable: [
                'fecha_prueba',
                'fecha_desde',
                'fecha_hasta',
                'comentario',
                'estado_id',
                'user_id',
                'nombre',
                'apellido',
                'email',
                'telefono'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'reservas'
        );
    }

    /* Tests de relaciones */
    public function test_reserva_user_relation_is_ok()
    {
        $reserva = new Reserva();
        $user = new User();
        $relation = $reserva->user();

        $this->assertBelongsToRelation(
            $relation,
            $reserva,
            $user,
            'user_id'
        );
    }

    public function test_reserva_estado_relation_is_ok()
    {
        $reserva = new Reserva();
        $estado = new Estado();
        $relation = $reserva->estado();

        $this->assertBelongsToRelation(
            $relation,
            $reserva,
            $estado,
            'estado_id'
        );
    }

    public function test_reserva_traslado_relation_is_ok()
    {
        $reserva = new Reserva();
        $traslado = new Traslado();

        $relation = $reserva->traslados();

        $this->assertHasManyRelation(
            $relation,
            $reserva,
            $traslado,
            'reserva_id'
        );
    }
}
<?php

namespace Tests\Unit;

use App\Models\Cliente;
use App\Models\Reserva;
use App\Models\TipoPersona;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class ClienteTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_clientes_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Cliente(), 
            fillable: [
                'nombre',
                'apellido',
                'telefono',
                'email',
                'fecha_nacimiento',
                'tipo_persona_id',
                'user_id'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'clientes'
        );
    }

    /* Tests de relaciones */
    public function test_reserva_relation_is_ok()
    {
        $cliente = new Cliente();
        $reserva = new Reserva();

        $relation = $cliente->reservas();

        $this->assertHasManyRelation(
            $relation,
            $cliente,
            $reserva,
            'cliente_id'
        );
    }

    public function test_cliente_user_relation_is_ok()
    {
        $cliente = new Cliente();
        $user = new User();
        $relation = $cliente->user();

        $this->assertBelongsToRelation(
            $relation,
            $cliente,
            $user,
            'user_id'
        );
    }

    public function test_cliente_tipo_persona_relation_is_ok()
    {
        $cliente = new Cliente();
        $tipoPersona = new TipoPersona();
        $relation = $cliente->tipo_persona();

        $this->assertBelongsToRelation(
            $relation,
            $cliente,
            $tipoPersona,
            'tipo_persona_id'
        );
    }
}
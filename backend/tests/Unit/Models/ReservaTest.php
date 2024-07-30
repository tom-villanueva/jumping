<?php

namespace Tests\Unit;

use App\Models\Equipo;
use App\Models\Estado;
use App\Models\Reserva;
use App\Models\Traslado;
use App\Models\User;
use App\Repositories\Reserva\ReservaRepository;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function test_reserva_equipo_relation_is_ok()
    {
        $reserva = new Reserva();
        $equipo = New Equipo();

        $relation = $reserva->equipos();

        $this->assertBelongsToManyRelation(
            $relation,
            $reserva,
            $equipo,
            "reserva_equipo",
            "reserva_id",
            "equipo_id",
            "id",
            "id",
            function($query, $model, BelongsToMany $relation) {
                $this->assertTrue($query->getQuery()->wheres[1]['type'] === 'Null');
                $this->assertTrue($query->getQuery()->wheres[1]['column'] === 'reserva_equipo.deleted_at');

                $pivotColumns = ['id', 'altura', 'peso', 'nombre', 'apellido', 'num_calzado'];
                foreach ($pivotColumns as $column) {
                    $this->assertContains($column, $relation->getPivotColumns());
                }
            }
        );
    }

    public function test_can_get_reservas_with_scope_dates()
    {
        $reserva1 = Reserva::factory()->create([
            'fecha_desde' => '2024-07-15',
            'fecha_hasta' => '2024-07-20'
        ]);
        $reserva2 = Reserva::factory()->create([
            'fecha_desde' => '2024-07-15',
            'fecha_hasta' => '2024-07-20'
        ]);
        $reserva3 = Reserva::factory()->create([
            'fecha_desde' => '2024-07-10',
            'fecha_hasta' => '2024-07-14'
        ]);
        $reserva4 = Reserva::factory()->create([
            'fecha_desde' => '2024-07-13',
            'fecha_hasta' => '2024-07-17'
        ]);

        $repository = new ReservaRepository(new Reserva(), request());

        $result1 = $repository->get([
            'filter' => [
                'fecha_desde_after' => '2024-07-15'
            ]
        ]);

        $this->assertCount(2, $result1);
        
        $result2 = $repository->get([
            'filter' => [
                'fecha_desde_between' => '2024-07-13,2024-07-15'
            ]
        ]);
        
        $this->assertCount(3, $result2);
    }
}
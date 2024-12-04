<?php

namespace Tests\Unit;

use App\Models\TipoEquipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class TipoEquipoTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_tipo_equipos_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new TipoEquipo(), 
            fillable: [
                'descripcion',
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'tipo_equipos'
        );
    }

    /* Tests de relaciones */
}
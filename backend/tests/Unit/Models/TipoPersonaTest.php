<?php

namespace Tests\Unit;

use App\Models\TipoPersona;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class TipoPersonaTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_tipo_personas_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new TipoPersona(), 
            fillable: [
                'id',
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'tipo_personas'
        );
    }

    /* Tests de relaciones */
}
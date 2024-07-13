<?php

namespace Tests\Unit;

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
                'id',
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'traslados'
        );
    }

    /* Tests de relaciones */
}
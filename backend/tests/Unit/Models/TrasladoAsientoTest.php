<?php

namespace Tests\Unit;

use App\Models\TrasladoAsiento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class TrasladoAsientoTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_traslado_asientos_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new TrasladoAsiento(), 
            fillable: [
                'id',
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'traslado_asientos'
        );
    }

    /* Tests de relaciones */
}
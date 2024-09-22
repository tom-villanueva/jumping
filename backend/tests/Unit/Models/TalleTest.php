<?php

namespace Tests\Unit;

use App\Models\Talle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class TalleTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_talle_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Talle(), 
            fillable: [
                'id',
                'descripcion'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'talle'
        );
    }
}
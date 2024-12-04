<?php

namespace Tests\Unit;

use App\Models\Cliente;
use App\Models\Reserva;
use App\Models\Voucher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class VoucherTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_vouchers_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Voucher(), 
            fillable: [
                'descripcion',
                'fecha_expiracion',
                'dias',
                'reserva_id',
                'cliente_id'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'vouchers'
        );
    }

    /* Tests de relaciones */
    public function test_voucher_reserva_relation_is_ok()
    {
        $voucher = new Voucher();
        $reserva = new Reserva();
        $relation = $voucher->reserva();

        $this->assertBelongsToRelation(
            $relation,
            $voucher,
            $reserva,
            'reserva_id'
        );
    }

    public function test_voucher_cliente_relation_is_ok()
    {
        $voucher = new Voucher();
        $cliente = new Cliente();
        $relation = $voucher->cliente();

        $this->assertBelongsToRelation(
            $relation,
            $voucher,
            $cliente,
            'cliente_id'
        );
    }
}
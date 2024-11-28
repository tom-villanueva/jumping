<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteVoucherControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_voucher()
    {
        $voucher = Voucher::factory()->create();

        $response = $this->deleteJson("/api/vouchers/{$voucher->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_voucher()
    {
        $user = $this->createStubUser();

        $voucher = Voucher::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/vouchers/{$voucher->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('vouchers', [
            'id' => $voucher->id,
        ]);
    }
}
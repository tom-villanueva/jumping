<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetVoucherControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_vouchers()
    {
        Voucher::factory()->count(3)->create();

        $response = $this->getJson('api/vouchers');

        $response->assertStatus(401);
    }

    public function test_user_can_get_vouchers()
    {
        Voucher::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/vouchers');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_voucher_by_id()
    {
        $voucher = Voucher::factory()->create();

        $response = $this->getJson("api/vouchers/{$voucher->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_voucher_by_id()
    {
        $voucher = Voucher::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/vouchers/{$voucher->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $voucher->id,
        ]);
    }
}
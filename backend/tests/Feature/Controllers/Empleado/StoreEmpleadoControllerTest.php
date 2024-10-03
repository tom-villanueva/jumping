<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreEmpleadoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_empleado()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'name' => null,
            'email' => null,
            'password' => 123,
            'password_confirmation' => 1234,
            'isAdmin' => null
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/empleados', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'name', 'email', 'password', 'isAdmin' ]);
    }

	public function test_unauthorized_user_cannot_store_empleado()
	{
		$response = $this->postJson('/api/empleados', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_empleado()
    {
        $user = $this->createStubUser();

        $data = [
            'name' => 'Tomás Villanueva',
            'email' => 'tomas@jumping.com',
            'password' => 'Tomi1234!',
            'password_confirmation' => 'Tomi1234!',
            'isAdmin' => false
        ];

        $hashedPassword = Hash::make($data["password"]);

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/empleados", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "name" => $data['name'],
            'email' => $data["email"],
            'isAdmin' => $data["isAdmin"]
        ]);
        
        $this->assertDatabaseHas('empleados', [
            "id" => $response['id'],
        ]);
    }
}
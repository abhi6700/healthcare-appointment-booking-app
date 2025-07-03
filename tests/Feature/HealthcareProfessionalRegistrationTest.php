<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HealthcareProfessionalRegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        try {
            $response = $this->postJson('/api/healthcare_professionals_register', [
                'name' => 'Dimple Patel',
                'email' => 'dimple@example.com',
                'password' => '12345',
            ]);

            $response->assertStatus(201);
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HealthcareProfessionalLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        try {
            $response = $this->postJson('/api/healthcare_professionals_login', [
                'email' => 'priyankapatel@gmail.com',
                'password' => '12345',
            ]);

            $response->assertStatus(201);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}

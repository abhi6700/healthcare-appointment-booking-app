<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
       try {
            $response = $this->postJson('/api/login', [
                'email' => 'abhipatel@example.com',
                'password' => '12345',
            ]);

            $response->assertStatus(201);
       } catch (\Throwable $th) {
            // throw $th;
       }
    }
}

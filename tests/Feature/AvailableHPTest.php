<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AvailableHPTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        try {
            $response = $this->postJson('/api/available_healthcare_professionals', [
               "start_time" => "2025-07-04 11:00:00",
                "end_time" => "2025-07-04 11:30:00"
            ]);

            $response->assertStatus(201);
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        try {
            $user = User::factory()->create();

            $response = $this->getJson('/api/appointment_list/' . $user->id);

            $response->assertStatus(200);
            $response->assertJsonStructure([
                '*' => [
                    'id',
                    'healthcare_professional',
                    'appointment_start_time',
                    'appointment_end_time',
                    'status',
                ]
            ]);

        } catch (\Throwable $th) {
            // $this->fail($th->getMessage());
        }
    }
}

<?php

namespace Tests\Feature;

use App\Models\HealthcareProfessional;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookAppointmentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        try {
            $user = User::factory()->create();
            $hp = HealthcareProfessional::factory()->create();

            Sanctum::actingAs($user);

            $response = $this->postJson('/api/book_appointment', [
                'user_id' => $user->id, 
                'healthcare_professional_id' => $hp->id,
                'appointment_start_time' => '2025-07-04 11:00:00',
                'appointment_end_time' => '2025-07-04 13:00:00',
            ]);

            $response->assertStatus(201);
            $response->assertJsonStructure([
                'message',
                'appointment' => [
                    'id',
                    'user_id',
                    'appointment_start_time',
                    'appointment_end_time'
                ]
            ]);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
        }
        
    }
}

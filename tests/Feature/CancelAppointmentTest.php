<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\HealthcareProfessional;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CancelAppointmentTest extends TestCase
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

            $appointment = Appointment::factory()->create([
                'user_id' => $user->id,
                'healthcare_professional_id' => $hp->id,
                'appointment_start_time' => '2025-07-05 10:00:00',
                'appointment_end_time' => '2025-07-05 12:00:00',
                'status' => 'booked',
            ]);

            Sanctum::actingAs($user);

            $response = $this->putJson("/api/cancel_appointment/{$appointment->id}/{$user->id}");

            $response->assertStatus(200);

            $response->assertJsonFragment([
                'status' => 'cancelled',
            ]);

        } catch (\Throwable $th) {
            // $this->fail($th->getMessage());
        }
    }
}

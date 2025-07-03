<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'healthcare_professional_id' => 1,
            'appointment_start_time' => "2025-07-06 10:00:00",
            'appointment_end_time' => "2025-07-06 10:00:00",
            'status' => 'Booked'
        ];
    }
}

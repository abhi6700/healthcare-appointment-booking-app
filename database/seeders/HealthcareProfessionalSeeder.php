<?php

namespace Database\Seeders;

use App\Models\HealthcareProfessional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HealthcareProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([
            [
                'name' => 'Priyanka Patel',
                'email' => 'priyankapatel@gmail.com',
                'password' => Hash::make('12345'),
                'specialty' => 'Ortho',
            ],
            [
                'name' => 'Meet Patel',
                'email' => 'meetpatel@gmail.com',
                'password' => Hash::make('12345'),
                'specialty' => 'ENT',
            ],
            [
                'name' => 'Vaidika Patel',
                'email' => 'vinipatel@gmail.com',
                'password' => Hash::make('12345'),
                'specialty' => 'Eye Specialist',
            ],
            [
                'name' => 'Kamal Patel',
                'email' => 'kamalpatel@gmail.com',
                'password' => Hash::make('12345'),
                'specialty' => 'General',
            ],
            [
                'name' => 'Komal Patel',
                'email' => 'komalpatel@gmail.com',
                'password' => Hash::make('12345'),
                'specialty' => 'Surgeons',
            ]
        ]);

        $users->each(function($user){
            HealthcareProfessional::insert($user);
        });
    }
}

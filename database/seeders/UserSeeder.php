<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([
            [
                'name' => 'Abhi Patel',
                'email' => 'abhipatel@gmail.com',
                'password' => Hash::make('12345'),
            ],
            [
                'name' => 'Bhavik Patel',
                'email' => 'bhavikpatel@gmail.com',
                'password' => Hash::make('12345'),
            ],
            [
                'name' => 'Vaishali Patel',
                'email' => 'vaishalipatel@gmail.com',
                'password' => Hash::make('12345'),
            ],
            [
                'name' => 'Nikita Patel',
                'email' => 'nikitapatel@gmail.com',
                'password' => Hash::make('12345'),
            ],
            [
                'name' => 'Hardik Patel',
                'email' => 'hardikpatel@gmail.com',
                'password' => Hash::make('12345'),
            ]
        ]);

        $users->each(function($user){
            User::insert($user);
        });
    }
}

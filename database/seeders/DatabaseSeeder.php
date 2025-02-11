<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Plan::insert([
            [
            'name' => 'Basic Plan',
            'features' => 'Full access',
            'amount' => '10.00',
            ],
            [
            'name' => 'Premium Plan',
            'features' => 'Full access',
            'amount' => '20.00',
            ],
            [
            'name' => 'Trial Plan',
            'features' => 'Full access',
            'amount' => '0.00',
            ]
        ]);
    }
}

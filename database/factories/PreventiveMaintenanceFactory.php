<?php

namespace Database\Factories;

use App\Enums\MaintenanceStatus;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreventiveMaintenanceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'asset_id' => Asset::factory(),
            'frequency' => fake()->randomElement(['Weekly', 'Monthly', 'Quarterly', 'Semiannual', 'Annual']),
            'last_maintenance' => fake()->dateTimeBetween('-120 days', '-10 days'),
            'next_maintenance' => fake()->dateTimeBetween('-5 days', '+60 days'),
            'technician_id' => User::factory(),
            'status' => fake()->randomElement(MaintenanceStatus::cases()),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enums\Priority;
use App\Enums\WorkOrderStatus;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkOrderFactory extends Factory
{
    public function definition(): array
    {
        $status = fake()->randomElement(WorkOrderStatus::cases());

        return [
            'number' => 'WO-'.fake()->unique()->numerify('#####'),
            'title' => fake()->randomElement(['Inspect vibration', 'Replace worn belt', 'Calibrate sensor', 'Resolve leak', 'Annual safety check']),
            'description' => fake()->paragraph(),
            'asset_id' => Asset::factory(),
            'technician_id' => User::factory(),
            'priority' => fake()->randomElement(Priority::cases()),
            'status' => $status,
            'start_date' => fake()->dateTimeBetween('-30 days', '+5 days'),
            'due_date' => fake()->dateTimeBetween('now', '+45 days'),
            'completion_date' => $status === WorkOrderStatus::Completed ? fake()->dateTimeBetween('-20 days', 'now') : null,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enums\AssetStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => 'AST-'.fake()->unique()->numerify('####'),
            'name' => fake()->randomElement(['Air Compressor', 'Packaging Line', 'Forklift', 'Generator', 'Chiller', 'Conveyor']).' '.fake()->numberBetween(1, 99),
            'category' => fake()->randomElement(['HVAC', 'Production', 'Electrical', 'Fleet', 'Facilities']),
            'location' => fake()->randomElement(['Plant A', 'Plant B', 'Warehouse', 'Office', 'Loading Dock']),
            'manufacturer' => fake()->company(),
            'model' => strtoupper(fake()->bothify('MX-###')),
            'serial_number' => strtoupper(fake()->bothify('SN??####')),
            'purchase_date' => fake()->dateTimeBetween('-6 years', '-3 months'),
            'status' => fake()->randomElement(AssetStatus::cases()),
            'description' => fake()->sentence(14),
        ];
    }
}

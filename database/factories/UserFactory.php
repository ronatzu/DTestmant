<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => fake()->phoneNumber(),
            'avatar' => Str::of(fake()->name())->explode(' ')->map(fn (string $part) => $part[0])->take(2)->implode(''),
            'status' => fake()->randomElement(['active', 'active', 'inactive']),
            'remember_token' => Str::random(10),
        ];
    }
}

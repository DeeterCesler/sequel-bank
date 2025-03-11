<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->unique()->numerify('#######'),
            'type' => fake()->randomElement(['checking', 'savings']),
            'balance' => fake()->randomFloat(2, 0, 10000),
            'status' => fake()->randomElement(['active', 'inactive', 'suspended']),
        ];
    }
}

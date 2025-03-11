<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => Account::factory(),
            'type' => fake()->randomElement(['deposit', 'withdrawal', 'transfer']),
            'amount' => fake()->randomFloat(2, 1, 10000),
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement(['pending', 'completed', 'failed']),
        ];
    }
}

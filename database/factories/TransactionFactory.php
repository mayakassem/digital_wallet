<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

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
            'client_id' => Client::factory(),
            'reference' => $this->faker->uuid(),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'transaction_date' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'bank_name' => $this->faker->randomElement(['CIB', 'HSBC', 'QNB', ' PayTech', 'Acme']),
        ];
    }
}

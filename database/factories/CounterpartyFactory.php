<?php

namespace Database\Factories;

use App\Models\Counterparty;
use Illuminate\Database\Eloquent\Factories\Factory;

class CounterpartyFactory extends Factory
{
    protected $model = Counterparty::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'email' => rand(1, 1000) . fake()->safeEmail()
        ];
    }
}

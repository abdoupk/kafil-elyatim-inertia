<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    protected $model = Income::class;

    public function definition(): array
    {
        return [
            'cnr' => fake()->numberBetween(0, 5000),
            'cnas' => fake()->numberBetween(0, 5000),
            'casnos' => fake()->numberBetween(0, 5000),
            'pension' => fake()->numberBetween(0, 5000),
            'account' => fake()->numberBetween(0, 5000),
            'other_income' => fake()->numberBetween(0, 5000),
            'total_income' => fake()->numberBetween(0, 5000),
            'sponsor_id' => fake()->numberBetween(0, 5000),
            'tenant_id' => fake()->uuid,
        ];
    }
}

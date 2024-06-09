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
            'name' => fake()->name,
            'value' => fake()->numberBetween(0, 100000),
        ];
    }
}

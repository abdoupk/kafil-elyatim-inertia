<?php

namespace Database\Factories;

use App\Models\IncomeSponsor;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeSponsorFactory extends Factory
{
    protected $model = IncomeSponsor::class;

    public function definition(): array
    {
        return [
            'income_id' => fake()->uuid,
            'tenant_id' => fake()->uuid,
            'id' => fake()->uuid,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Baby;
use Illuminate\Database\Eloquent\Factories\Factory;

class BabyFactory extends Factory
{
    protected $model = Baby::class;

    public function definition(): array
    {
        return [
            'baby_milk_quantity' => fake()->randomNumber(),
            'baby_milk_type' => fake()->word,
            'diapers_quantity' => fake()->randomNumber(),
            'diapers_type' => fake()->word,
            'tenant_id' => fake()->uuid,
            'orphan_id' => fake()->uuid,
            'family_id' => fake()->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

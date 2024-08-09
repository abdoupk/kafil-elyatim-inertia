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
            'baby_milk_quantity' => fake()->numberBetween(1, 4),
            'baby_milk_type' => fake('ar_SA')->realText(10),
            'diapers_quantity' => fake()->numberBetween(1, 4),
            'diapers_type' => fake('ar_SA')->realText(10),
            'tenant_id' => fake()->uuid,
            'orphan_id' => fake()->uuid,
            'family_id' => fake()->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

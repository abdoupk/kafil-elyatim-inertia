<?php

namespace Database\Factories;

use App\Models\FamilyFurnishing;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyFurnishingFactory extends Factory
{
    protected $model = FamilyFurnishing::class;

    public function definition(): array
    {
        return [
            'family_id' => fake()->uuid,
            'furnishing_id' => fake()->uuid,
            'value' => fake()->numberBetween(1000, 100000),
        ];
    }
}

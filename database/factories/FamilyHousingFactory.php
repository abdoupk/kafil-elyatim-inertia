<?php

namespace Database\Factories;

use App\Models\FamilyHousing;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyHousingFactory extends Factory
{
    protected $model = FamilyHousing::class;

    public function definition(): array
    {
        return [
            'family_id' => fake()->uuid,
            'housing_id' => fake()->uuid,
            'value' => fake()->numberBetween(1000, 100000),
        ];
    }
}

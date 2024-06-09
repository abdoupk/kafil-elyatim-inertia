<?php

namespace Database\Factories;

use App\Models\FamilySponsorship;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilySponsorshipFactory extends Factory
{
    protected $model = FamilySponsorship::class;

    public function definition(): array
    {
        return [
            'family_id' => fake()->uuid,
            'value' => fake()->numberBetween(1000, 100000),
            'tenant_id' => fake()->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

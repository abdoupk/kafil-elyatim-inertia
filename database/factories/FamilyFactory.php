<?php

namespace Database\Factories;

use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyFactory extends Factory
{
    protected $model = Family::class;

    public function definition(): array
    {
        return [
            'name' => fake('ar_SA')->name,
            'report' => fake('ar_SA')->sentences(3, true),
            'tenant_id' => fake()->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

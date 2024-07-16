<?php

namespace Database\Factories;

use App\Models\PrivateSchool;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrivateSchoolFactory extends Factory
{
    protected $model = PrivateSchool::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'tenant_id' => fake()->uuid,
            'quota' => fake()->randomNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

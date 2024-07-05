<?php

namespace Database\Factories;

use App\Models\AcademicAchievement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcademicAchievementFactory extends Factory
{
    protected $model = AcademicAchievement::class;

    public function definition(): array
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
            'orphan_id' => fake()->uuid,
            'academic_level' => fake()->word,
            'first_trimester' => fake()->randomFloat(min: 3, max: 18),
            'second_trimester' => fake()->randomFloat(min: 3, max: 18),
            'third_trimester' => fake()->randomFloat(min: 3, max: 18),
            'total' => fake()->randomFloat(min: 3, max: 18),
            'first_semester' => fake()->randomFloat(min: 3, max: 18),
            'second_semester' => fake()->randomFloat(min: 3, max: 18),
            'tenant_id' => fake()->uuid,
        ];
    }
}

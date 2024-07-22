<?php

namespace Database\Factories;

use App\Models\AcademicAchievement;
use App\Models\AcademicLevel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

class AcademicAchievementFactory extends Factory
{
    protected $model = AcademicAchievement::class;

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
            'orphan_id' => fake()->uuid,
            'academic_level_id' => AcademicLevel::inRandomOrder()->first()->id,
            'academic_year' => now()->subYears(random_int(0, 3))->year,
            'first_trimester' => fake()->randomFloat(min: 3, max: 18),
            'second_trimester' => fake()->randomFloat(min: 3, max: 18),
            'third_trimester' => fake()->randomFloat(min: 3, max: 18),
            'average' => fake()->randomFloat(min: 3, max: 18),
            'first_semester' => fake()->randomFloat(min: 3, max: 18),
            'second_semester' => fake()->randomFloat(min: 3, max: 18),
            'tenant_id' => fake()->uuid,
        ];
    }
}

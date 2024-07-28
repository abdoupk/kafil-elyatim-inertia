<?php

namespace Database\Factories;

use App\Models\AcademicLevel;
use App\Models\CollegeAchievement;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollegeAchievementFactory extends Factory
{
    protected $model = CollegeAchievement::class;

    public function definition(): array
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
            'orphan_id' => fake()->uuid,
            'first_semester' => fake()->randomFloat(),
            'second_semester' => fake()->randomFloat(),
            'speciality' => fake()->word(),
            'academic_level_id' => AcademicLevel::inRandomOrder()->first()->id,
            'average' => fake()->randomFloat(),
            'year' => fake()->numberBetween(2010, 2020),
            'note' => fake()->realText(),
            'university' => fake()->word(),
            'tenant_id' => fake()->uuid,
        ];
    }
}

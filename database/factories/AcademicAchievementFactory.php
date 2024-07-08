<?php

namespace Database\Factories;

use App\Models\AcademicAchievement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcademicAchievementFactory extends Factory
{
    protected $model = AcademicAchievement::class;

    protected array $academicLevels = [
        [
            'phase' => 'الطور الابتدائي',
            'levels' => [
                'الاولى ابتدائي',
                'الثانية ابتدائي',
                'الثالثة ابتدائي',
                'الرابعة ابتدائي',
                'الخامسة ابتدائي',
            ],
        ],
        [
            'phase' => 'الطور المتوسط',
            'levels' => [
                'الاولى المتوسط',
                'الثانية المتوسط',
                'الثالثة المتوسط',
                'الرابعة المتوسط',
            ],
        ],
        [
            'phase' => 'الطور الثانوي',
            'levels' => [
                'الاولى ثانوي',
                'الثانية ثانوي',
                'الثالثة ثانوي',
            ],
        ],
        [
            'phase' => 'الطور الجامعي',
            'levels' => [
                'الاولى ليسانس',
                'الثانية ليسانس',
                'الثالثة ليسانس',
                'الاولى ماستر',
                'الثانية ماستر',
                'الاولى دكتوراة',
                'الثانية دكتوراة',
                'الثالثة دكتوراة',
                'الرابعة دكتوراة',
                'الخامسة دكتوراة',
            ],
        ],
    ];

    public function definition(): array
    {
        $academicLevel = fake()->randomElement($this->academicLevels);
        $academicLevelName = $academicLevel['levels'][fake()->numberBetween(0, count($academicLevel['levels']) - 1)];

        return [
            'created_at' => now(),
            'updated_at' => now(),
            'orphan_id' => fake()->uuid,
            'academic_level' => $academicLevelName,
            'academic_phase' => $academicLevel['phase'],
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

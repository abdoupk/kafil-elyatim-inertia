<?php

namespace Database\Factories;

use App\Models\AcademicAchievement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

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
                'الاولى ثانوي آداب',
                'الاولى ثانوي علوم',
                'الثانية ثانوي رياضيات',
                'الثانية ثانوي تقني رياضي',
                'الثانية ثانوي علوم تجريبية',
                'الثانية ثانوي تسيير و اقتصاد',
                'الثانية ثانوي أدب و فلسفة',
                'الثانية ثانوي لغات أجنبية',
                'الثالثة ثانوي رياضيات',
                'الثالثة ثانوي تقني رياضي',
                'الثالثة ثانوي علوم تجريبية',
                'الثالثة ثانوي ت و إقتصاد',
                'الثالثة ثانوي أدب و فلسفة',
                'الثالثة ثانوي لغات أجنبية',
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

    /**
     * @throws RandomException
     */
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

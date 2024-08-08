<?php

namespace Database\Factories;

use App\Models\AcademicLevel;
use App\Models\Sponsor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SponsorFactory extends Factory
{
    protected $model = Sponsor::class;

    public function definition(): array
    {
        return [
            //            'card_number' => fake('ar_SA')->regexify('[1-9][0-9]{8}'),
            'first_name' => fake('ar_SA')->firstName,
            'last_name' => fake('ar_SA')->lastName,
            'phone_number' => fake('ar_SA')->regexify('(06|07|05)[0-9]{8}'),
            'sponsor_type' => fake('ar_SA')->shuffleArray(['father', 'mother', 'grandMother', 'grandFather'])[0],
            'birth_date' => now()->subYears(fake()->numberBetween(25, 60))->toDate(),
            'father_name' => fake('ar_SA')->name,
            'mother_name' => fake('ar_SA')->name,
            'birth_certificate_number' => fake('ar_SA')->regexify('[0-9]{8}'),
            'academic_level_id' => AcademicLevel::inRandomOrder()->first()->id,
            'function' => fake('ar_SA')->jobTitle,
            'health_status' => fake('ar_SA')->word,
            'diploma' => fake('ar_SA')->word,
            'tenant_id' => fake()->uuid,
            'created_by' => fake()->uuid,
            'ccp' => fake()->regexify('[1-9][0-9]{8}'),
            'gender' => fake()->randomElement(['male', 'female']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

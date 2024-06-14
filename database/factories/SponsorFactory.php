<?php

namespace Database\Factories;

use App\Models\Sponsor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

class SponsorFactory extends Factory
{
    protected $model = Sponsor::class;

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'card_number' => fake('ar_SA')->regexify('[1-9][0-9]{8}'),
            'name' => fake('ar_SA')->name,
            'phone_number' => fake('ar_SA')->regexify('(06|07|05)[0-9]{8}'),
            'sponsorship_type' => fake('ar_SA')->shuffleArray(['father', 'mother', 'grandMother', 'grandFather'])[0],
            'birth_date' => now()->subYears(random_int(25, 60))->toDate(),
            'father_name' => fake('ar_SA')->name,
            'mother_name' => fake('ar_SA')->name,
            'birth_certificate_number' => fake('ar_SA')->regexify('[0-9]{8}'),
            'academic_level' => fake('ar_SA')->word,
            'function' => fake('ar_SA')->jobTitle,
            'health_status' => fake('ar_SA')->word,
            'diploma' => fake('ar_SA')->word,
            'tenant_id' => fake()->uuid,
            'created_by' => fake()->uuid,
            'deleted_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

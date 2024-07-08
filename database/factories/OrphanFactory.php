<?php

namespace Database\Factories;

use App\Models\Orphan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

class OrphanFactory extends Factory
{
    protected $model = Orphan::class;

    protected array $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'first_name' => fake('ar_SA')->firstName,
            'last_name' => fake('ar_SA')->lastName,
            'birth_date' => now()->subYears(random_int(1, 35))->toDate(),
            'family_status' => fake('ar_SA')->word,
            'health_status' => fake('ar_SA')->word,
            'academic_level' => fake('ar_SA')->word,
            'shoes_size' => random_int(30, 45),
            'pants_size' => fake()->shuffleArray($this->sizes)[0],
            'shirt_size' => fake()->shuffleArray($this->sizes)[0],
            'gender' => fake()->randomElement(['male', 'female']),
            'note' => fake('ar_SA')->paragraph(5),
            'tenant_id' => fake()->uuid,
            'family_id' => fake()->uuid,
            'created_at' => now()->subDays(random_int(0, 35)),
            'updated_at' => now()->subDays(random_int(0, 35)),
        ];
    }
}

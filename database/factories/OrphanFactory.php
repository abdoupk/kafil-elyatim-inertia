<?php

namespace Database\Factories;

use App\Models\ClothesSize;
use App\Models\Orphan;
use App\Models\ShoeSize;
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
            'academic_level_id' => 5,
            'shoes_size' => ShoeSize::inRandomOrder()->first()->id,
            'pants_size' => ClothesSize::inRandomOrder()->first()->id,
            'shirt_size' => ClothesSize::inRandomOrder()->first()->id,
            'gender' => fake()->randomElement(['male', 'female']),
            'note' => fake('ar_SA')->realText(500),
            'tenant_id' => fake()->uuid,
            'family_id' => fake()->uuid,
            'created_at' => now()->subDays(random_int(0, 35)),
            'updated_at' => now()->subDays(random_int(0, 35)),
        ];
    }
}

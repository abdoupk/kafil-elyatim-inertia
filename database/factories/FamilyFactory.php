<?php

namespace Database\Factories;

use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

class FamilyFactory extends Factory
{
    protected $model = Family::class;

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'name' => fake('ar_SA')->name,
            'zone_id' => fake()->uuid,
            'address' => fake('ar_SA')->address,
            'file_number' => fake()->randomNumber(),
            'start_date' => now()->subDays(random_int(100, 1000)),
            'report' => fake('ar_SA')->sentences(3, true),
            'tenant_id' => fake()->uuid,
            'created_at' => now()->subDays(random_int(0, 35)),
            'updated_at' => now()->subDays(random_int(0, 35)),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

class BranchFactory extends Factory
{
    protected $model = Branch::class;

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'created_at' => now()->subDays(random_int(0, 35)),
            'updated_at' => now()->subDays(random_int(0, 35)),
            'city_id' => $this->faker->randomNumber(),
            'tenant_id' => $this->faker->words(),
        ];
    }
}

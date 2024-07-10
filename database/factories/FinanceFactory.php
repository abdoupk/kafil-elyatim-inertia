<?php

namespace Database\Factories;

use App\Models\Finance;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

class FinanceFactory extends Factory
{
    protected $model = Finance::class;

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->numberBetween(-100000, 1000000),
            'description' => fake('ar_SA')->paragraph(),
            'date' => now()->subDays(random_int(1, 720)),
            'created_by' => fake()->uuid,
            'tenant_id' => fake()->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

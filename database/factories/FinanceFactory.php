<?php

namespace Database\Factories;

use App\Models\Finance;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceFactory extends Factory
{
    protected $model = Finance::class;

    public function definition(): array
    {
        return [
            'amount' => fake()->numberBetween(-1000000, 1000000),
            'description' => fake('ar_SA')->realText(),
            'date' => now()->subDays(fake()->numberBetween(1, 913)),
            'specification' => fake()->randomElement(['drilling_wells', 'monthly_sponsorship', 'eid_el_adha', 'eid_el_fitr', 'other', 'school_entry', 'analysis', 'therapy', 'ramadan_basket']),
            'created_by' => fake()->uuid,
            'tenant_id' => fake()->uuid,
            'created_at' => now()->subDays(fake()->numberBetween(1, 913)),
            'updated_at' => now(),
        ];
    }
}

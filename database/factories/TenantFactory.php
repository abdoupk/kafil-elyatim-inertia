<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake('ar_SA')->firstName,
            'last_name' => fake('ar_SA')->lastName,
            'email' => fake()->safeEmail,
            'phone' => fake()->regexify('(06|07|05)[0-9]{8}'),
            'domain' => Str::domain(fake()->word.'-'.fake()->word),
            'password' => 'password',
            'association' => fake('ar_SA')->company,
            'ccp' => fake()->regexify('[0-9]{12}'),
            'cpa' => fake()->regexify('[0-9]{12}'),
        ];
    }
}

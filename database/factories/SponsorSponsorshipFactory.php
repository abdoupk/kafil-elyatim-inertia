<?php

namespace Database\Factories;

use App\Enums\SponsorshipType;
use App\Models\SponsorSponsorship;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

class SponsorSponsorshipFactory extends Factory
{
    protected $model = SponsorSponsorship::class;

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'sponsor_id' => fake()->uuid,
            'type' => SponsorshipType::cases()[random_int(0, count(SponsorshipType::cases()) - 1)]->label(),
            'value' => random_int(0, 100) > 50 ? random_int(10000, 100000) : fake()->word,
            'tenant_id' => fake()->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

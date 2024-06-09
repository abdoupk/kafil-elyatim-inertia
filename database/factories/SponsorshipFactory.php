<?php

namespace Database\Factories;

use App\Enums\SponsorshipType;
use App\Models\Sponsorship;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

class SponsorshipFactory extends Factory
{
    protected $model = Sponsorship::class;

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'type' => SponsorshipType::cases()[random_int(0, count(SponsorshipType::cases()) - 1)]->name,
            'tenant_id' => fake()->uuid,
            'deleted_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enums\OrphanSponsorshipType;
use App\Models\OrphanSponsorship;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

class OrphanSponsorshipFactory extends Factory
{
    protected $model = OrphanSponsorship::class;

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'orphan_id' => fake()->uuid,
            'type' => OrphanSponsorshipType::cases()[random_int(0, count(OrphanSponsorshipType::cases()) - 1)]->name,
            'value' => fake('ar_SA')->word,
            'tenant_id' => fake()->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Preview;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreviewFactory extends Factory
{
    protected $model = Preview::class;

    public function definition(): array
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
            'report' => fake()->paragraph(8),
            'preview_date' => now(),
            'family_id' => fake()->uuid,
            'tenant_id' => fake()->uuid,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Furnishing;
use Illuminate\Database\Eloquent\Factories\Factory;

class FurnishingFactory extends Factory
{
    protected $model = Furnishing::class;

    public function definition(): array
    {
        return [
            'name' => fake('ar_SA')->word,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Housing;
use Illuminate\Database\Eloquent\Factories\Factory;

class HousingFactory extends Factory
{
    protected $model = Housing::class;

    public function definition(): array
    {
        return [
            'name' => fake('ar_SA')->word,
        ];
    }
}

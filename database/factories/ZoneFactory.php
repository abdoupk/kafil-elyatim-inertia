<?php

namespace Database\Factories;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZoneFactory extends Factory
{
    protected $model = Zone::class;

    public function definition(): array
    {
        return [
            'name' => ' منطقة رقم '.fake()->numberBetween(1, 20),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Need;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class NeedFactory extends Factory
{
    protected $model = Need::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'demand' => $this->faker->word(),
            'status' => $this->faker->word(),
            'note' => $this->faker->word(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Benefactor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BenefactorFactory extends Factory
{
    protected $model = Benefactor::class;

    public function definition(): array
    {
        return [
            'tenant_id' => Str::uuid(),
            'id' => Str::uuid(),
        ];
    }
}

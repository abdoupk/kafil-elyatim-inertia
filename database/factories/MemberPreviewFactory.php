<?php

namespace Database\Factories;

use App\Models\MemberPreview;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberPreviewFactory extends Factory
{
    protected $model = MemberPreview::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->words(),
            'preview_id' => $this->faker->words(),
        ];
    }
}

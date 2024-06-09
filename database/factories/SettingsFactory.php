<?php

namespace Database\Factories;

use App\Enums\Appearance;
use App\Enums\ColorScheme;
use App\Enums\Layout;
use App\Enums\Theme;
use App\Models\Settings;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

class SettingsFactory extends Factory
{
    protected $model = Settings::class;

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'theme' => Theme::cases()[random_int(0, count(Theme::cases()) - 1)]->value,
            'color_scheme' => ColorScheme::cases()[random_int(0, count(ColorScheme::cases()) - 1)]->value,
            'layout' => Layout::cases()[random_int(0, count(Layout::cases()) - 1)]->value,
            'appearance' => Appearance::cases()[random_int(0, count(Appearance::cases()) - 1)]->value,
        ];
    }
}

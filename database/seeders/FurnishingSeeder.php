<?php

namespace Database\Seeders;

use App\Models\Furnishing;
use Illuminate\Database\Seeder;
use Str;

class FurnishingSeeder extends Seeder
{
    public function run(): void
    {
        $furnishings = ['television', 'refrigerator', 'fireplace', 'washing_machine', 'water_heater', 'oven', 'wardrobe', 'cupboard', 'covers', 'mattresses', 'other_furnishings'];

        Furnishing::insert(array_map(static function ($furnishing) {
            return ['id' => Str::uuid(), 'name' => $furnishing];
        }, $furnishings));
    }
}

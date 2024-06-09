<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\FamilyFurnishing;
use App\Models\Furnishing;
use Illuminate\Database\Seeder;

class FamilyFurnishingSeeder extends Seeder
{
    public function run(): void
    {
        $statutes = ['exists', 'needs_repair', 'new', 'old', 'other'];
        Family::select(['id'])->get()->each(function (Family $family) use ($statutes) {
            Furnishing::inRandomOrder()->limit(3)->get()->each(function (Furnishing $furnishing) use ($family, $statutes) {
                FamilyFurnishing::create([
                    'family_id' => $family->id,
                    'furnishing_id' => $furnishing->id,
                    'value' => array_rand($statutes),
                ]);
            });
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\FamilyHousing;
use App\Models\Housing;
use Illuminate\Database\Seeder;
use Random\RandomException;

class FamilyHousingSeeder extends Seeder
{
    /**
     * @throws RandomException
     */
    public function run(): void
    {
        $values = [random_int(1, 3), random_int(8000, 12000), 'other', 'with_family', random_int(20, 100)];

        Family::select(['id'])->get()->each(function (Family $family) use ($values) {
            Housing::inRandomOrder()->limit(3)->get()->each(function (Housing $housing) use ($family, $values) {
                FamilyHousing::create([
                    'family_id' => $family->id,
                    'housing_id' => $housing->id,
                    'value' => array_rand($values),
                ]);
            });
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Housing;
use Illuminate\Database\Seeder;
use Str;

class HousingSeeder extends Seeder
{
    public function run(): void
    {
        $housings = ['private', 'with_family', 'inheritance', 'rental', 'other', 'number_of_rooms', 'housing_number'];

        Housing::insert(array_map(static function ($housing) {
            return ['id' => Str::uuid(), 'name' => $housing];
        }, $housings));
    }
}

<?php

namespace Database\Seeders;

use App\Enums\FamilySponsorshipType;
use App\Models\Family;
use Illuminate\Database\Seeder;
use Random\RandomException;

class FamilySponsorshipSeeder extends Seeder
{
    public function run(): void
    {
        $types = FamilySponsorshipType::cases();

        Family::lazy(100)->each(function (Family $family) use ($types) {
            $family->sponsorships()->createMany(array_map(
                /**
                 * @throws RandomException
                 */
                static fn ($type) => [
                    'type' => $type->label(),
                    'value' => $type->valueType() === 'number' ? random_int(1000, 10000) : fake('ar_SA')->word,
                    'tenant_id' => $family->tenant_id,
                ], $types));
        });
    }
}

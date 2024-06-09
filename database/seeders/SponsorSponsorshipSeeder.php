<?php

namespace Database\Seeders;

use App\Enums\SponsorSponsorshipType;
use App\Models\Sponsor;
use Illuminate\Database\Seeder;
use Random\RandomException;

class SponsorSponsorshipSeeder extends Seeder
{
    public function run(): void
    {
        $types = SponsorSponsorshipType::cases();

        Sponsor::get(['id', 'tenant_id'])->lazy()->each(function (Sponsor $sponsor) use ($types) {
            $sponsor->sponsorships()->createMany(array_map(
                /**
                 * @throws RandomException
                 */
                function ($type) use ($sponsor) {
                    return [
                        'type' => $type->label(),
                        'value' => $this->setValue($type),
                        'tenant_id' => $sponsor->tenant_id,
                    ];
                }, $types));
        });
    }

    /**
     * @throws RandomException
     */
    private function setValue(SponsorSponsorshipType $type): int|string
    {
        return match ($type->valueType()) {
            'number' => random_int(1000, 10000),
            'text' => fake('ar_SA')->paragraph(2),
            default => fake('ar_SA')->word,
        };
    }
}

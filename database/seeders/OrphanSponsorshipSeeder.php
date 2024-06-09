<?php

namespace Database\Seeders;

use App\Enums\OrphanSponsorshipType;
use App\Models\Orphan;
use App\Models\OrphanSponsorship;
use Illuminate\Database\Seeder;

class OrphanSponsorshipSeeder extends Seeder
{
    public function run(): void
    {
        $types = OrphanSponsorshipType::cases();

        $orphans = Orphan::get(['id', 'tenant_id'])->toArray();

        $orphansSponsorships = [];

        foreach ($types as $type) {
            foreach ($orphans as $orphan) {
                $orphansSponsorships[] = [
                    'id' => fake()->uuid,
                    'orphan_id' => $orphan['id'],
                    'type' => $type->label(),
                    'value' => fake()->boolean ? 'true' : 'false',
                    'tenant_id' => $orphan['tenant_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        OrphanSponsorship::insert($orphansSponsorships);
    }
}

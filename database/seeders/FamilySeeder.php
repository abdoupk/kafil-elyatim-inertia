<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Orphan;
use App\Models\SecondSponsor;
use App\Models\Sponsor;
use App\Models\Spouse;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Seeder;
use Random\RandomException;

class FamilySeeder extends Seeder
{
    public function run(): void
    {
        Tenant::select('id')->get()->each(
            /**
             * @throws RandomException
             */
            function (Tenant $tenant) {
                for ($i = 0; $i < 10; $i++) {
                    $family = Family::factory()->create([
                        'tenant_id' => $tenant->id,
                        'zone_id' => Zone::inRandomOrder()->first()?->id,
                    ]);

                    Spouse::factory()->create([
                        'tenant_id' => $tenant->id,
                        'family_id' => $family->id,
                    ]);

                    for ($j = 0; $j < random_int(2, 6); $j++) {
                        Orphan::factory()->create([
                            'tenant_id' => $tenant->id,
                            'family_id' => $family?->id,
                            'created_by' => User::whereTenantId($tenant->id)->inRandomOrder()->first()?->id,
                        ]);
                    }

                    SecondSponsor::factory()->create([
                        'tenant_id' => $tenant->id,
                        'family_id' => $family->id,
                    ]);

                    Sponsor::factory()->create([
                        'tenant_id' => $tenant->id,
                        'family_id' => $family->id,
                        'created_by' => User::whereTenantId($tenant->id)->inRandomOrder()->first()?->id,
                    ]);
                }
            });
    }
}

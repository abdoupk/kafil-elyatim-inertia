<?php

namespace Database\Seeders;

use App\Models\Baby;
use App\Models\Branch;
use App\Models\Family;
use App\Models\Need;
use App\Models\Orphan;
use App\Models\SecondSponsor;
use App\Models\Sponsor;
use App\Models\Spouse;
use App\Models\Tenant;
use App\Models\User;
use App\Models\VocationalTraining;
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
                        'branch_id' => Branch::whereTenantId($tenant->id)->inRandomOrder()->first()?->id,
                        'zone_id' => Zone::whereTenantId($tenant->id)->inRandomOrder()->first()?->id,
                        'created_by' => User::whereTenantId($tenant->id)->inRandomOrder()->first()->id,
                    ]);

                    Spouse::factory()->create([
                        'tenant_id' => $tenant->id,
                        'family_id' => $family->id,
                    ]);

                    SecondSponsor::factory()->create([
                        'tenant_id' => $tenant->id,
                        'family_id' => $family->id,
                    ]);

                    $sponsor = Sponsor::factory()->create([
                        'tenant_id' => $tenant->id,
                        'family_id' => $family->id,
                        'created_by' => User::whereTenantId($tenant->id)->inRandomOrder()->first()?->id,
                    ]);

                    for ($j = 0; $j < random_int(2, 6); $j++) {
                        $orphan = Orphan::factory()
                            ->hasAcademicAchievements(3, function (array $attributes, Orphan $orphan) {
                                return [
                                    'tenant_id' => $orphan->tenant_id,
                                    'orphan_id' => $orphan->id,
                                ];
                            })
                            ->hasVocationalTrainingAchievements(2, function (array $attributes, Orphan $orphan) {
                                return [
                                    'tenant_id' => $orphan->tenant_id,
                                    'vocational_training_id' => VocationalTraining::inRandomOrder()->first()?->id,
                                    'orphan_id' => $orphan->id,
                                ];
                            })
                            ->create([
                                'tenant_id' => $tenant->id,
                                'family_id' => $family?->id,
                                'created_by' => User::whereTenantId($tenant->id)->inRandomOrder()->first()?->id,
                                'sponsor_id' => $sponsor->id,
                            ]);

                        Baby::factory()->create([
                            'tenant_id' => $tenant->id,
                            'orphan_id' => $orphan->id,
                            'family_id' => $family->id,
                        ]);

                        Need::factory()->create([
                            'tenant_id' => $tenant->id,
                            'needable_id' => $orphan->id,
                            'needable_type' => 'orphan',
                        ]);

                        Need::factory()->create([
                            'tenant_id' => $tenant->id,
                            'needable_id' => $sponsor->id,
                            'needable_type' => 'sponsor',
                        ]);
                    }
                }
            });
    }
}

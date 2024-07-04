<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Sponsor;
use App\Models\SponsorSponsorship;
use Illuminate\Database\Seeder;

class SponsorSponsorshipSeeder extends Seeder
{
    public function run(): void
    {
        ray('123456');
        ray(Sponsor::get());
        ray(Family::first()->deceased()->get(['id', 'tenant_id']));
        Sponsor::get(['id', 'tenant_id'])->each(function (Sponsor $sponsor) {
            ray($sponsor);
            SponsorSponsorship::factory()->create([
                'sponsor_id' => $sponsor->id,
                'tenant_id' => $sponsor->tenant_id,
            ]);
        });
    }
}

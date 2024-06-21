<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        Tenant::pluck('id')->each(fn ($tenant) => Zone::factory()->count(10)->create(['tenant_id' => $tenant]));
    }
}

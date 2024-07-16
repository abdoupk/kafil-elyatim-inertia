<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Random\RandomException;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Tenant::select('id')->lazy(100)->each(/**
         * @throws RandomException
         */ function (Tenant $tenant) {
            Event::factory()->count(10)->create([
                'start_date' => now()->subDays(random_int(0, 8)),
                'end_date' => now()->addDays(random_int(0, 8)),
                'tenant_id' => $tenant->id,
                'school_id' => $tenant->schools->random()->first()->id,
            ]);
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $tenant1 = Tenant::factory()->create([
            'first_name' => 'Rezig',
            'last_name' => 'Chikh',
            'email' => 'test@example.com',
            'phone' => '0558494137',
            'domain' => 'foo.kafil.elyatim.test',
            'password' => 'password',
            'association' => 'kafil el yatim El-bayadh',
        ]);

        $tenant2 = Tenant::factory()->create([
            'first_name' => 'Rezig',
            'last_name' => 'Abderrahmane',
            'email' => 'test@example.com',
            'phone' => '0664954817',
            'domain' => 'bar.kafil.elyatim.test',
            'password' => 'password',
            'association' => 'kafil el yatim El-bayadh 02',
        ]);

        Domain::factory()->create([
            /* @phpstan-ignore-next-line */
            'tenant_id' => $tenant1?->id,
            /* @phpstan-ignore-next-line */
            'domain' => $tenant1->domain,
        ]);

        Domain::factory()->create([
            /* @phpstan-ignore-next-line */
            'tenant_id' => $tenant2?->id,
            /* @phpstan-ignore-next-line */
            'domain' => $tenant2?->domain,
        ]);

        $tenants = Tenant::factory(5)->create();

        for ($tenant = 0; $tenant < 5; $tenant++) {
            Domain::factory()->create([
                'tenant_id' => $tenants[$tenant]?->id,
                /* @phpstan-ignore-next-line */
                'domain' => $tenants[$tenant]?->domain,
            ]);

            User::factory(10)->create([
                'tenant_id' => $tenants[$tenant]?->id,
            ]);
        }
    }
}

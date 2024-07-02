<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Domain;
use App\Models\Inventory;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Seeder;
use Random\RandomException;

class TenantSeeder extends Seeder
{
    /**
     * @throws RandomException
     */
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

        $tenants = Tenant::factory(5)->create();
        $tenants[] = $tenant1;
        $tenants[] = $tenant2;

        foreach ($tenants as $tenant) {
            Domain::factory()->create([
                'tenant_id' => $tenant?->id,
                /* @phpstan-ignore-next-line */
                'domain' => $tenant?->domain,
            ]);

            Zone::factory()->count(10)->create(['tenant_id' => $tenant->id]);

            User::factory(10)->create([
                'tenant_id' => $tenant?->id,
            ]);

            Branch::factory(random_int(1, 6))->create([
                'tenant_id' => $tenant?->id,
                'president_id' => User::inRandomOrder()->whereTenantId(
                    $tenant?->id
                )->first()?->id,
            ]);

            Inventory::factory()->count(50)->create([
                'tenant_id' => $tenant?->id,
            ]);
        }
    }
}

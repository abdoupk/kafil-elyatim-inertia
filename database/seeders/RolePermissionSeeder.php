<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->call(PermissionSeeder::class);

        $this->call(RoleSeeder::class);

        Tenant::with('members')->each(function ($tenant) {
            $tenant->members->each(function (User $user, $key) {
                if ($key === 0) {
                    $user->assignRole('president');
                } elseif ($key === 1) {
                    $user->assignRole('vice_president');
                } else {
                    $user->assignRole('member');
                }
            });
        });
    }
}

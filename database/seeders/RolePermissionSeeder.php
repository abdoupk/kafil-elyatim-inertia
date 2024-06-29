<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        Tenant::with('members')->each(function ($tenant) {
            $tenant->members->each(function (User $user, $key) {
                if ($key === 0) {
                    $user->assignRole('super_admin');
                }

                if ($key === 1) {
                    $role = Role::create(['name' => 'vice_president']);

                    $user->assignRole($role);
                }

            });
        });
    }
}

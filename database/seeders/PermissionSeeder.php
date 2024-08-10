<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->setPermissionsTeamId(tenant('id'));

        $classes = ['members', 'families', 'sponsors', 'orphans', 'needs', 'zones', 'financial_transactions', 'branches', 'inventory', 'schools', 'lessons'];

        $permissionsMap = ['create', 'read', 'update', 'delete'];

        array_map(function ($class) use ($permissionsMap) {
            foreach ($permissionsMap as $permission) {
                Permission::create(['name' => $permission.'_'.$class]);
            }
        }, $classes);
    }
}

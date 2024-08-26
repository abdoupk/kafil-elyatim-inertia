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

        $models = ['members', 'families', 'roles', 'needs', 'zones', 'financial_transactions', 'branches', 'inventory', 'schools', 'lessons'];

        $permissionsMap = ['create', 'read', 'update', 'delete'];

        array_map(function ($model) use ($permissionsMap) {
            foreach ($permissionsMap as $permission) {
                Permission::create(['name' => $permission.'_'.$model]);
            }
        }, $models);

        $permissions = ['settings_update', 'settings_read', 'orphan_edit', 'orphan_read', 'sponsor_read', 'orphan_delete', 'sponsor_edit', 'sponsor_delete', 'occasions_save', 'occasions_export', 'occasions_read', 'orphans_export', 'financial_transactions_export', 'families_export', 'sponsors_export', 'trash_restore', 'trash_delete', 'archive_read'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

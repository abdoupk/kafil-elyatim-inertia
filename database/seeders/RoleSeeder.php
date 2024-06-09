<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $role1 = Role::create(['name' => 'member']);

        $role1->givePermissionTo('add families');

        $role1->givePermissionTo('delete families');

        $role2 = Role::create(['name' => 'admin']);

        $role2->givePermissionTo('edit families');

        Role::create(['name' => 'super_admin']);
    }
}

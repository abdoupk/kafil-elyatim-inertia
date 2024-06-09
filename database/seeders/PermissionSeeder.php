<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'edit families']);

        Permission::create(['name' => 'delete families']);

        Permission::create(['name' => 'add families']);
    }
}

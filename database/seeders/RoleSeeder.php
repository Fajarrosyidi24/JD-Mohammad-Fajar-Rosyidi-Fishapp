<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $allPermissions = Permission::all();
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->syncPermissions($allPermissions);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions($allPermissions);
        $guidePermissions = Permission::whereIn('name', [
            'Dashboard',
        ])->get();
        $guide = Role::firstOrCreate(['name' => 'Nelayan']);
        $guide->syncPermissions($guidePermissions);
    }
}

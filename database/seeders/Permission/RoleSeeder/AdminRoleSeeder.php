<?php

namespace Database\Seeders\Permission\RoleSeeder;

use App\PermissionsManager\Admin;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRoleSeeder
{
    public static function seed(): void 
    {
        $adminRole = Role::where('name', 'admin')->first();
        if (empty($adminRole)) {
            $adminRole = Role::create(['name' => 'admin']);
        }

        $admin = new Admin();
        $adminPermissions = $admin->getPermissions();
        foreach ($adminPermissions as $adminPermission) {
            $permission = Permission::where('name', $adminPermission)->first();
            if (empty($permission)) {
                Permission::create(['name' => $adminPermission]);
            }
            $adminRole->givePermissionTo($adminPermission);
        }
    }
}


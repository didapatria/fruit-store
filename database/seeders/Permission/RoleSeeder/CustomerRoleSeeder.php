<?php

namespace Database\Seeders\Permission\RoleSeeder;

use App\PermissionsManager\Customer;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CustomerRoleSeeder
{
    public static function seed(): void 
    {
        $customerRole = Role::where('name', 'customer')->first();
        if (empty($customerRole)) {
            $customerRole = Role::create(['name' => 'customer']);
        }

        $customer = new Customer();
        $customerPermissions = $customer->getPermissions();
        foreach ($customerPermissions as $customerPermission) {
            $permission = Permission::where('name', $customerPermission)->first();
            if (empty($permission)) {
                Permission::create(['name' => $customerPermission]);
            }
            $customerRole->givePermissionTo($customerPermission);
        }
    }
}
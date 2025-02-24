<?php

namespace Database\Seeders\Permission\RoleSeeder;

use App\PermissionsManager\Vendor;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class VendorRoleSeeder
{
    public static function seed(): void 
    {
        $vendorRole = Role::where('name', 'vendor')->first();
        if (empty($vendorRole)) {
            $vendorRole = Role::create(['name' => 'vendor']);
        }

        $vendor = new Vendor();
        $vendorPermissions = $vendor->getPermissions();
        foreach ($vendorPermissions as $vendorPermission) {
            $permission = Permission::where('name', $vendorPermission)->first();
            if (empty($permission)) {
                Permission::create(['name' => $vendorPermission]);
            }
            $vendorRole->givePermissionTo($vendorPermission);
        }
    }
}
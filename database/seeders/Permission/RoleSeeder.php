<?php

namespace Database\Seeders\Permission;

use Database\Seeders\Permission\RoleSeeder\AdminRoleSeeder;
use Database\Seeders\Permission\RoleSeeder\CustomerRoleSeeder;
use Database\Seeders\Permission\RoleSeeder\VendorRoleSeeder;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        AdminRoleSeeder::seed();
        CustomerRoleSeeder::seed();
        VendorRoleSeeder::seed();
    }
}
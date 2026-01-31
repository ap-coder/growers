<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $all_permissions = Permission::all();

        // Admin (id: 1) - All permissions
        $admin = Role::find(1);
        if ($admin) {
            $admin->permissions()->sync($all_permissions->pluck('id'));
        }

        // WCL-Developer (id: 3) - All permissions (same as Admin)
        $wclDeveloper = Role::find(3);
        if ($wclDeveloper) {
            $wclDeveloper->permissions()->sync($all_permissions->pluck('id'));
        }

        // Customer (id: 2) - Frontend/account only, NO admin access
        // Only gets: minimal frontend/account permissions
        $customer_permissions = $all_permissions->filter(function ($permission) {
            return in_array($permission->title, [
                'profile_password_edit',
                // Keep in sync with RolesTableSeeder minimal site permissions
                'site_product_access',
                'site_product_show',
            ]);
        });
        $customer = Role::find(2);
        if ($customer) {
            $customer->permissions()->sync($customer_permissions->pluck('id'));
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        // Create roles first
        $admin = Role::firstOrCreate(
            ['id' => 1],
            ['title' => 'Admin']
        );

        $customer = Role::firstOrCreate(
            ['id' => 2],
            ['title' => 'Customer']
        );

        $wclDeveloper = Role::firstOrCreate(
            ['id' => 3],
            ['title' => 'WCL Developer']
        );

        // Now assign permissions
        $all_permissions = Permission::all();

        // Grant all permissions to Admin
        $admin->permissions()->sync($all_permissions->pluck('id'));

        // Grant all permissions to WCL Developer
        $wclDeveloper->permissions()->sync($all_permissions->pluck('id'));

        // Grant selected permissions to Customer
        $customer_permissions = $all_permissions->filter(function ($permission) {
            return in_array($permission->title, [
                'profile_password_edit',
            ]);
        });
        $customer->permissions()->sync($customer_permissions->pluck('id'));
    }
}

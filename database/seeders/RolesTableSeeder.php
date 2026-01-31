<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        $all_permissions = Permission::all();

        Role::findOrFail(1)->permissions()->sync($all_permissions->pluck('id'));

        $wclDeveloper = Role::find(3);
        if ($wclDeveloper) {
            $wclDeveloper->permissions()->sync($all_permissions->pluck('id'));
        }

        $customer_permissions = $all_permissions->filter(function ($permission) {
            return in_array($permission->title, [
                'profile_password_edit',
                // Frontend product viewing permissions
                'site_product_access',
                'site_product_show',
            ]);
        });
        Role::findOrFail(2)->permissions()->sync($customer_permissions->pluck('id'));
    }
}

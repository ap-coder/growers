<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $permissions = [
            'variation_category_create',
            'variation_category_edit',
            'variation_category_show',
            'variation_category_delete',
            'variation_category_access',
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insertOrIgnore([
                'title' => $permission,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Assign to admin role (id=1)
        $adminRoleId = 1;
        $permissionIds = DB::table('permissions')
            ->whereIn('title', $permissions)
            ->pluck('id');

        foreach ($permissionIds as $permissionId) {
            DB::table('permission_role')->insertOrIgnore([
                'permission_id' => $permissionId,
                'role_id' => $adminRoleId,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $permissions = [
            'variation_category_create',
            'variation_category_edit',
            'variation_category_show',
            'variation_category_delete',
            'variation_category_access',
        ];

        $permissionIds = DB::table('permissions')
            ->whereIn('title', $permissions)
            ->pluck('id');

        DB::table('permission_role')->whereIn('permission_id', $permissionIds)->delete();
        DB::table('permissions')->whereIn('title', $permissions)->delete();
    }
};

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
            ['id' => 130, 'title' => 'collection_create'],
            ['id' => 131, 'title' => 'collection_edit'],
            ['id' => 132, 'title' => 'collection_show'],
            ['id' => 133, 'title' => 'collection_delete'],
            ['id' => 134, 'title' => 'collection_access'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insertOrIgnore($permission);
        }

        // Assign to Admin role (id: 1) and WCL-Developer role (id: 3)
        $permissionIds = [130, 131, 132, 133, 134];
        $roleIds = [1, 3];

        foreach ($roleIds as $roleId) {
            foreach ($permissionIds as $permissionId) {
                DB::table('permission_role')->insertOrIgnore([
                    'permission_id' => $permissionId,
                    'role_id' => $roleId,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('permission_role')->whereIn('permission_id', [130, 131, 132, 133, 134])->delete();
        DB::table('permissions')->whereIn('id', [130, 131, 132, 133, 134])->delete();
    }
};

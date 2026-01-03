<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            ClientsTableSeeder::class,
            SettingsTableSeeder::class,
            MenusTableSeeder::class,
        ]);



        $this->call(SettingsTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(ProductCollectionsTableSeeder::class);
        $this->call(ProductCollectionItemsTableSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Client;
use App\Models\Location;
use App\Models\Team;
use App\Models\User;
use App\Models\ClientPrice;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            ClientsTableSeeder::class,
        ]);

        Product::factory(24)->withClientPrices()->create();
        ProductCategory::factory(5)->create();
        Client::factory(5)->create();
        Location::factory(5)->create();
        Team::factory(5)->create();


    }
}

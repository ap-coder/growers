<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    public function run(): void
    {
        $tablePrefix = config('menu.table_prefix', '');
        $menusTable = $tablePrefix . config('menu.table_name_menus', 'menus');

        $menus = [
            [
                'name' => 'Main Navigation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quick Links',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Categories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Seasonal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product Categories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table($menusTable)->upsert(
            $menus,
            ['name'],
            ['updated_at']
        );
    }
}

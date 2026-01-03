<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Main Navigation',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Quick Links',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Categories',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Seasonal',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Product Categories',
                'created_at' => '2026-01-01 23:46:02',
                'updated_at' => '2026-01-01 23:46:02',
            ),
        ));
        
        
    }
}
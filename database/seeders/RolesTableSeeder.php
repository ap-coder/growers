<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Admin',
                'created_at' => NULL,
                'updated_at' => '2026-01-01 00:17:36',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Customer',
                'created_at' => NULL,
                'updated_at' => '2026-01-01 00:17:36',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'WCL-Developer',
                'created_at' => '2026-01-01 00:17:36',
                'updated_at' => '2026-01-01 00:17:36',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
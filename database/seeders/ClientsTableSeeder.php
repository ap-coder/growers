<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('clients')->delete();
        
        \DB::table('clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Harmons',
                'created_at' => '2024-10-14 07:50:12',
                'updated_at' => '2024-10-14 07:50:12',
                'deleted_at' => NULL,
                'team_id' => NULL,
                'published' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Albertsons',
                'created_at' => '2024-11-26 03:34:19',
                'updated_at' => '2024-11-26 03:34:19',
                'deleted_at' => NULL,
                'team_id' => NULL,
                'published' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Walgreens',
                'created_at' => '2024-11-26 03:34:47',
                'updated_at' => '2024-11-26 03:34:47',
                'deleted_at' => NULL,
                'team_id' => NULL,
                'published' => 1,
            ),
        ));
        
        
    }
}
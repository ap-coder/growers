<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Developer',
                'email' => 'phillip.madsen.21@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$z.bi4fT/U5ZIPMOszHr9JeaSnn2c/5VbO6gUUnPdzfwjmFvYC0kxO',
                'approved' => 1,
                'verified' => 1,
                'verified_at' => '2024-03-02 20:52:19',
                'verification_token' => '',
                'two_factor' => 0,
                'two_factor_code' => '',
                'remember_token' => NULL,
                'two_factor_expires_at' => NULL,
                'created_at' => NULL,
                'updated_at' => '2024-08-30 00:52:59',
                'deleted_at' => NULL,
                'team_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Linda Muir',
                'email' => 'linda@pacificplantgrowers.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$QY5vM555jy08vBteNPK61emgcspDKoQbuIQW6j5onput8LlkrOCBK',
                'approved' => 1,
                'verified' => 1,
                'verified_at' => '2024-08-30 00:56:11',
                'verification_token' => NULL,
                'two_factor' => 0,
                'two_factor_code' => NULL,
                'remember_token' => NULL,
                'two_factor_expires_at' => NULL,
                'created_at' => '2024-08-30 00:56:10',
                'updated_at' => '2024-08-30 00:56:11',
                'deleted_at' => NULL,
                'team_id' => NULL,
            ),
        ));
        
        
    }
}
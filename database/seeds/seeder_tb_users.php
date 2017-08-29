<?php

use Illuminate\Database\Seeder;

class seeder_tb_users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_user')->insert([
        	'user_username' => 'admin',
        	'user_studentid' => '5900000021',
        	'user_fbid' => '',
        	'dispname' => 'administrator',
        	'user_hpassword' => 'admin',
        	'user_session' => str_random(10),
        ]);
    }
}

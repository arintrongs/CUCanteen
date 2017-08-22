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
        	'user_username' => str_random(10),
        	'user_studentid' => str_random(10),
        	'user_fbid' => str_random(10),
        	'dispname' => str_random(10),
        	'user_hpassword' => str_random(10),
        	'user_session' => str_random(10),
        ]);
    }
}

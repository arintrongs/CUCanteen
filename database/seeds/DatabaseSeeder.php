<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(seeder_tb_comments::class);
        $this->call(seeder_tb_shops::class);
        $this->call(seeder_tb_users::class);
    }
}

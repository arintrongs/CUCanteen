<?php
use App\Http\Controllers\Canteen\UserController;
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
        UserController::addAdmin();
    }
}

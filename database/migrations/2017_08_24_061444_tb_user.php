<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tb_user'))Schema::create('tb_user', function(Blueprint $table){
            $table -> bigIncrements('user_id');
            $table -> string('user_username', 30);
            $table -> string('user_studentid', 11)->nullable();
            $table -> string('user_fbid', 22)->nullable();
            $table -> string('user_dispname', 30);
            $table -> string('user_hpassword');
            $table -> binary('user_disppict')->nullable();
            $table -> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tb_user');
    }
}

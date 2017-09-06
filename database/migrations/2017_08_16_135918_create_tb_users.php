<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $this->down();
        Schema::create('tb_user', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_username', 30);
            $table->string('user_role',15);
            $table->string('user_studentid', 15)->comment('Student\'s ID (user after accquired CUNET API)')->nullable();
            $table->string('user_fbid', 30)->comment('Student\'s Facebook ID (if there is nothing else to do)')->nullable();
            $table->string('user_email',60)->nullable();
            $table->string('user_dispname', 60);
            $table->string('user_hpassword');
            $table->text('user_session')->comment('in case of usage (can be deleted)') -> nullable();
            $table->binary('user_disppict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_user');
    }
}
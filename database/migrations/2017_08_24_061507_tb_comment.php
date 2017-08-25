<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tb_comment'))Schema::create('tb_comment', function(Blueprint $table){
            $table -> bigIncrements('comment_id');
            $table -> bigInteger('shop_id') -> unsigned();
            $table -> bigInteger('user_id') -> unsigned();
            $table -> bigInteger('food_id') -> unsigned();
            $table -> double('comment_rating', 0);
            $table -> string('comment_text') -> nullable;
        });

        Schema::table('tb_comment', function(Blueprint $table){
            $table -> foreign('shop_id') -> references('shop_id') -> on('tb_shop')
                        -> onDelete('cascade')
                        -> onUpdate('cascade');

            $table -> foreign('user_id') -> references('user_id') -> on('tb_user')
                        -> onDelete('cascade')
                        -> onUpdate('cascade');

            $table -> foreign('food_id') -> references('food_id') -> on('tb_food')
                        -> onDelete('set_null')
                        -> onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tb_comment');
    }
}

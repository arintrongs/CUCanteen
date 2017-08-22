<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //$this->down();
        Schema::create('tb_comment', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->integer('user_id');
            $table->integer('shop_id');
            $table->float('comment_rating');
            $table->text('comment_text')->comment('Review wrtten by users');
            $table->text('comment_food')->comment('Recommended Food')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_comment');
    }
}
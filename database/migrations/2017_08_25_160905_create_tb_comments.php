<?php

use App\Comment;
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
        // $this->down();
        Schema::create('tb_comment', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('comment_id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('shop_id')->unsigned();
            $table->bigInteger('food_id')->unsigned();
            $table->double('comment_rating', 0);
            $table->text('comment_text')->comment('Review wrtten by users')->nullable();
            //$table->text('comment_food')->comment('Recommended Food')->nullable();
            $table->timestamp(Comment::CREATED_AT);
            $table->softDeletes();

        });

        Schema::table('tb_comment', function (Blueprint $table) {
            $table -> foreign('user_id') -> references('user_id') -> on('tb_user')
                        -> onDelete('cascade')
                        -> onUpdate('cascade');

            $table -> foreign('shop_id') -> references('shop_id') -> on('tb_shop')
                        -> onDelete('cascade')
                        -> onUpdate('cascade');

            $table -> foreign('food_id') -> references('food_id') -> on('tb_food')
                        -> onDelete('cascade')
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
        Schema::dropIfExists('tb_comment');
    }
}
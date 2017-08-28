<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbFood extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $this->down();
        Schema::create('tb_food', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->bigIncrements('food_id');
            $table->bigInteger('shop_id')->unsigned();
            $table->string('food_name');
            $table->softDeletes();
        });

        Schema::table('tb_food', function (Blueprint $table) {
            $table -> foreign('shop_id') 
                        -> references('shop_id')->on('tb_shop')
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
        Schema::dropIfExists('tb_food');
    }
}

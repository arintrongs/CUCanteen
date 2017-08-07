<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_shop', function (Blueprint $table) {
            $table->increments('shop_id');
            $table->binary('shop_img');
            $table->string('shop_name', 60);
            $table->string('shop_location', 60);
            $table->text('shop_description');
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
        Schema::dropIfExists('tb_shop');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbShops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //$this->down();
        Schema::create('tb_shop', function (Blueprint $table) {
            $table->increments('shop_id');
            $table->string('shop_name', 60);
            $table->string('shop_location', 60)->comment('Location name');
            $table->time('shop_time')->comment('Open/Close Time');
            $table->double('shop_lat')->comment('Shop Latitude');
            $table->double('shop_lng')->comment('Shop Longtitude');
            $table->text('shop_description');
            $table->binary('shop_picture')->nullable();
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

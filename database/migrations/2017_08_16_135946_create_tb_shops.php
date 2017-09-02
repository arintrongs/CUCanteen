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
        // $this->down();
        Schema::create('tb_shop', function (Blueprint $table) {
            $table->bigIncrements('shop_id')->unsigned();
            $table->string('shop_name');
            $table->string('shop_location')->comment('Location name')->nullable();
            $table->time('shop_time')->comment('Open/Close Time')->nullable();
            $table->double('shop_lat')->comment('Shop Latitude')->nullable();
            $table->double('shop_lng')->comment('Shop Longtitude')->nullable();
            $table->text('shop_description')->nullable();
            $table->boolean('shop_isVeg', FALSE);
            $table->boolean('shop_isHalal', FALSE);
            $table->binary('shop_picture')->nullable();
            $table->timestamps();
            $table->softDeletes();
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

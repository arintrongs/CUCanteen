<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tb_shop'))Schema::create('tb_shop', function(Blueprint $table){
            $table -> bigIncrements('shop_id');
            $table -> string('shop_name');
            $table -> string('shop_location') -> comment('Location description');
            $table -> string('shop_time') -> comment('Open - Close time') -> nullable();
            $table -> double('shop_lat') -> comment('Shop\'s latitude') -> nullable();
            $table -> double('shop_lng') -> comment('Shop\'s longitude') -> nullable();
            $table -> string('shop_description') -> nullable();
            $table -> boolean('shop_isVeg', FALSE);
            $table -> boolean('shop_isHalal', FALSE);
            $table -> binary('shop_picture') -> nullable();
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
        Schema::drop('tb_shop');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbPicturepath extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tb_picturepath', function (Blueprint $table) {
            $table->bigInteger('shop_id')->unsigned();
            $table->string('shop_picturepath')->nullable();
        });
       Schema::table('tb_picturepath', function (Blueprint $table) {
            $table -> foreign('shop_id') -> references('shop_id') -> on('tb_shop')
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
        Schema::dropIfExists('tb_picturepath');
    }
}

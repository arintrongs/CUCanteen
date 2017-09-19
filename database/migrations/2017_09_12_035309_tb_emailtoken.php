<?php

use App\EmailToken;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbEmailtoken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EmailToken', function(Blueprint $table){
            $table->bigIncrements('email_id');
            $table->bigInteger('user_id');
            $table->string('token',60)->nullable();
            $table->timestamp(EmailToken::CREATED_AT);
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
        Schema::dropIfExists('EmailToken');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *用户表
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('openid', 28)->comment('用户openid');
            $table->tinyInteger('sex')->comment('用户性别 0：未知、1：男、2：女');
            $table->string('avatar')->nullable()->comment('用户头像');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
            $table->unique('openid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

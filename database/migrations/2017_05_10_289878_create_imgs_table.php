<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIMGSTable extends Migration
{
    /**
     * Run the migrations.
     * 图片表
     * @return void
     */
    public function up()
    {
        Schema::create('imgs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img')->comment('图片');
            $table->Integer('common_id')->comment('关联表ID');
            $table->string('common_type')->comment('所属表:1是搬家表2是送水表3开锁4租房5回收6煤气7公厕');
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
        Schema::dropIfExists('imgs');
    }
}

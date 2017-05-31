<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicToiletsTable extends Migration
{
    /**
     * Run the migrations.
     * 公厕表
     * @return void
     */
    public function up()
    {
        Schema::create('public_toilets', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id')->comment('关联表ID');
            $table->string('address')->comment('地址');
            $table->string('name')->comment('名称');
            $table->double('longitude',10,6)->comment('经度');
            $table->double('latitude',10,6)->comment('纬度');
            $table->timestamp('verify')->comment('审核时间')->nullable();
            $table->string('remark')->comment('备注信息')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0待审核1审核通过2驳回3垃圾信息');
            $table->boolean('type')->default(true)->comment('true显示false隐藏');
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
        Schema::dropIfExists('public_toilets');
    }
}

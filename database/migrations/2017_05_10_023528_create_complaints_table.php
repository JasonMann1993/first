<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *投诉表
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->string('name')->comment('名称');
            $table->string('reasons')->comment('1信息有误2假的3收费 多选 中间用逗号隔开');
            $table->string('imgs')->comment('图片');
            $table->integer('common_id')->comment('关联表 ID');
            $table->string('common_type',30)->comment('关联表 类型');
            $table->string('remark')->comment('备注信息')->nullable();
            $table->tinyInteger('status')->default('1')->comment('1待处理2已处理');
            $table->string('detail')->comment('详情');
            $table->timestamp('audited_at')->comment('审核时间');
            $table->softDeletes();
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
        Schema::dropIfExists('complaints');
    }
}

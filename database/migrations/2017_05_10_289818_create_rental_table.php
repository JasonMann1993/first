<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalTable extends Migration
{
    /**
     * Run the migrations.
     * 租房表
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id')->comment('关联表ID');
            $table->string('name')->comment('名称');
            $table->string('cell_name')->comment('小区名称');
            $table->string('size')->comment('房屋大小');
            $table->string('address')->comment('地址');
            $table->double('longitude',10,6)->comment('经度');
            $table->double('latitude',10,6)->comment('纬度');
            $table->string('phone',20)->comment('电话');
            $table->string('form')->comment('房屋类型（三室一厅）')->nullable();
            $table->decimal('price', 10, 2)->comment('价格');
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
        Schema::dropIfExists('rentals');
    }
}

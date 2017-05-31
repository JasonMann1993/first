<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 审核日志表
 * Class CreateAduitLogsTable
 */
class CreateAduitLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('remark')->nullable()->comment('备注');
            $table->string('value')->nullable()->comment('修改为');
            $table->integer('common_id')->comment('公共 ID');
            $table->string('common_type')->comment('公共 Type');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
}

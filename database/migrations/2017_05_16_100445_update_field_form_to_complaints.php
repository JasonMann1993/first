<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFieldFormToComplaints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('audited_at');
        });
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('imgs');
            $table->string('detail')->comment('详情')->nullable()->change();
            $table->timestamp('audited_at')->comment('审核时间')->nullable();
            $table->string('reasons')->comment('投诉原因')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
          Schema::table('complaints', function (Blueprint $table) {
            //
            $table->string('imgs')->comment('图片');
            $table->integer('common_id')->comment('关联表 ID');
            $table->string('common_type',30)->comment('关联表 类型');
        });
    }
}

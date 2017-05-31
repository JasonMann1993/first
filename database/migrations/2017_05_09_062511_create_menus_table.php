<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->comment('parent id');
            $table->string('name',20)->comment('名称');
            $table->integer('sort')->default(50)->comment('排序 id 1~100');
            $table->string('url')->nullalble()->comment('Url');
            $table->boolean('status')->default(true)->comment('状态 显示 隐藏');
            $table->string('icon',20)->nullable()->comment('icon');

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
        Schema::dropIfExists('menus');
    }
}

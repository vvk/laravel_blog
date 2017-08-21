<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->comment('banner名称');
            $table->string('remark', 200)->comment('备注');
            $table->string('url', 200)->comment('跳转链接');
            $table->string('image', 200)->comment('图片链接');
            $table->tinyInteger('target')->default(1)->comment('是否新标签打开，1:是，2:否');
            $table->tinyInteger('rank')->default(50)->comment('排序，0-255，越大优先级越高	');
            $table->tinyInteger('status')->default(1)->comment('状态：1:显示，2:不显示，3:删除');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('banner');
    }
}

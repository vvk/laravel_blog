<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->comment('友情链接名称');
            $table->string('url', 200)->comment('链接url');
            $table->string('description', 255)->comment('描述');
            $table->tinyInteger('rank')->default(50)->comment('排序');
            $table->string('image', 200)->comment('图片');
            $table->tinyInteger('status')->default(1)->comment('0:不显示，1:显示	');
            $table->unsignedInteger('create_time')->default(0)->comment('添加时间');
            $table->unsignedInteger('modify_time')->default(0)->comment('修改时间');
            $table->unsignedInteger('delete_time')->default(0)->comment('删除时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('links');
    }
}

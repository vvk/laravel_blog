<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->comment('分类名称');
            $table->unsignedInteger('parent_id')->default(0)->comment('上级分类');
            $table->string('keywords', 255)->comment('关键词');
            $table->string('description', 255)->comment('描述');
            $table->string('thumb', 200)->comment('分类图片');
            $table->tinyInteger('status')->default(1)->comment('状态，0:禁用，1:启用，2:删除');
            $table->unsignedInteger('create_time')->default(0)->comment('添加时间');
            $table->unsignedInteger('modify_time')->default(0)->comment('修改时间');
            $table->unsignedInteger('delete_time')->default(0)->comment('删除时间');
            $table->tinyInteger('is_visible')->default(1)->comment('是否可见，0:否，1:是');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category');
    }
}

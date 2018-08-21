<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->comment('标题');
            $table->string('keywords', 255)->comment('关键词');
            $table->string('description', 255)->comment('描述');
            $table->string('thumb', 200)->comment('缩略图');
            $table->tinyInteger('status')->default(0)->comment('状态：0:草稿，1:完成未发布，2:发布，3:删除');
            $table->unsignedInteger('create_time')->default(0)->comment('创建时间');
            $table->unsignedInteger('modify_time')->default(0)->comment('修改时间');
            $table->unsignedInteger('publish_time')->default(0)->comment('发布时间');
            $table->unsignedInteger('delete_time')->default(0)->comment('删除时间');
            $table->unsignedInteger('view_count')->default(0)->comment('浏览次数');
            $table->tinyInteger('is_reprint')->default(0)->comment('是否为转载，0:不是，1:是');
            $table->string('reprint_url', 100)->comment('转载链接');
            $table->longText('content')->comment('文章内容');
            $table->tinyInteger('editor_type')->default(1)->comment('编辑器类型，1:markdown，2:百度编辑器');
            $table->longText('markdown')->comment('文章内容');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article');
    }
}

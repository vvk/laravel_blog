<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->comment('配置字段');
            $table->string('title', 100)->comment('配置名称');
            $table->text('value')->comment('值');
            $table->tinyInteger('type')->default(1)->comment('1:基本配置，2：显示配置');
            $table->tinyInteger('status')->default(1)->comment('状态：0:禁用，1:启用，2:删除');
            $table->tinyInteger('form_type')->default(1)->comment('表单类型：1:input，2:checkbox，3:textarea');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('options');
    }
}

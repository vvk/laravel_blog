<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFigureBedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('figure_bed', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('url', 100)->default('')->comment('图片路径');
            $table->date('date')->comment('创建时间');
            $table->integer('ip')->unsigned()->default(0)->comment('ip地址');
            $table->integer('ctime')->unsigned()->default(0)->comment('创建时间');
            $table->index(['date', 'ip']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('figure_bed');
    }
}

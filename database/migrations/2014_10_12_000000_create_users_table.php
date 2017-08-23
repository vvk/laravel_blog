<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('username', 100)->comment('用户名');
            $table->string('nikename', 100)->default('')->comment('昵称');
            $table->string('email', 100)->default('');
            $table->string('password', 60);
            $table->string('remember_token', 100)->default('');
            $table->unsignedInteger('last_time')->default(0);
            $table->string('last_ip', 20)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

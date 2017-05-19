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
            $table->increments('id');                           //用户ID
            $table->string('name');                             //昵称
            $table->string('avatar')->nullable();               //头像地址
            $table->string('email')->unique();                  //邮箱
            $table->string('password');                         //密码
            $table->string('activation_token')->nullable();     //邮箱激活token
            $table->boolean('activated')->default(false);       //是否激活
            $table->boolean('is_admin')->default(false);        //是否是管理员
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

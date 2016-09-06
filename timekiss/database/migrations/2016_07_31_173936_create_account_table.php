<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('account', function (Blueprint $table) {
      $table->increments('accountId');
      $table->string('telephone', 20)->index();
      $table->string('username', 30);
      $table->string('token', 60)->index();
      $table->string('password', 64);
      $table->string('uuid', 40);
      $table->dateTime('registerTime')->comment('注册时间');
      $table->dateTime('lastLoginTime')->comment('最后登录时间');
      $table->date('birthday');
      $table->string('starSigns', 30)->comment('星座');
      $table->string('profession', 40)->comment('职业'); # 职业
      $table->string('email', 50);
      $table->string('avatar', 200)->comment('头像');
      $table->string('slogan', 50)->comment('个性签名'); # 个性签名
      $table->tinyInteger('gender')->comment('性别:(1男性/2女性)');
      $table->string('status', 30)->comment('帐号状态:(1active/0blocked)');
      $table->string('timezone', 32)->comment('用户时区');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('account');
  }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHosterTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('hoster', function (Blueprint $table) {
      $table->increments('hid');
      $table->integer('accountId')->default(0)->comment('帐号id');
      $table->string('description', 100)->default('')->comment('描述');
      $table->string('name', 30)->comment('姓名');
      $table->string('nickname', 30)->default('')->comment('昵称');
      $table->tinyInteger('gender')->default(1)->comment('性别:(1男性/2女性)');
      $table->string('telephone', 20)->default('')->comment('电话');
      $table->string('weixin', 50)->default('')->comment('微信');
      $table->integer('age')->default(0)->comment('年龄');
      $table->string('maritalStatus', 3)->default('0')->comment('婚姻状况');
      $table->string('feature', 50)->default('')->comment('特征');
      $table->string('avatar', 100)->default('')->comment('头像');
      $table->string('photo', 100)->default('')->comment('照片');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('hoster');
  }

}

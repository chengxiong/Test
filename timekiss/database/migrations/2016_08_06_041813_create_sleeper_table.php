<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSleeperTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('sleeper', function (Blueprint $table) {
      $table->increments('sid');
      $table->integer('accountId')->comment('帐号id');
      $table->string('name', 20)->comment('姓名');
      $table->tinyInteger('gender')->comment('性别:(1男性/2女性)');
      $table->dateTime('birthDay')->comment('生日');
      $table->tinyInteger('starSign')->comment('星座');
      $table->string('professional', 200)->comment('职业');
      $table->string('weixin')->comment('微信');
      $table->string('email', 30);
      $table->string('telephone')->comment('电话号码');
      //手机型号
      $table->string('phoneModel')->comment('手机型号');
      //试睡民宿
      $table->integer('bid')->comment('试睡觉民宿id');
      $table->string('wantCity', 50)->comment('向往试睡地');
      //目前所在地
      $table->string('city', 50)->comment('目前所在地');
      // 报名试睡时间
      $table->dateTime('sleepDate')->comment('试睡时间');
      $table->string('reason', 1000)->comment('试睡理由');
      // 后台配置属性
      $table->tinyInteger('level')->comment('试睡等级');
      $table->tinyInteger('sendSms')->comment('短信通知');
      $table->string('note', 50)->comment('备注');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('sleeper');
  }

}

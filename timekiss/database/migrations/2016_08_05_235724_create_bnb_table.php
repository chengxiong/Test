<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBnbTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('bnb', function (Blueprint $table) {
      $table->increments('bid');
      $table->string('name', 30)->comment('民宿标题');
      $table->string('title', 50)->comment('名字');
      $table->string('subTitle1', 100)->comment('副标题1');
      $table->string('subTitle2', 100)->comment('副标题2');
      $table->string('author', 30)->comment('民宿设计师');
      $table->string('address', 200)->comment('地址');
      $table->string('lng', 10)->comment('经度');
      $table->string('lat', 10)->comment('纬度');
      $table->string('phone', 20)->comment('联系电话');
      $table->string('status', 3)->comment('(0联络中,1未上架,2已上架)');
      $table->double('score1', 100, 2)->comment('颜值');
      $table->double('score2', 100, 2)->comment('X值');
      $table->double('score3', 100, 2)->comment('睡值');
      $table->double('score', 100, 2)->comment('平均值');
      $table->integer('clickNum')->comment('点击数');
      $table->integer('likeNum')->comment('收藏数');
      $table->dateTime('createTime')->comment('创建时间');
      $table->dateTime('updateTime')->comment('修改时间');
      $table->string('contactStatus', 50)->comment('联络情况');
      $table->string('website', 50)->comment('网址');
      $table->dateTime('buildDate', 50)->comment('建筑时间');
      $table->mediumInteger('totalRoom')->comment('房间数');
      $table->string('hosterSay', 600)->comment('房东说');
      $table->string('level', 3)->comment('等级');
      $table->string('province', 3)->comment('省');
      $table->string('city', 3)->comment('城市');
      $table->string('region', 3)->comment('区域');
      $table->string('country', 3)->comment('国家');
    });
  }
  
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('bnb');
  }

}

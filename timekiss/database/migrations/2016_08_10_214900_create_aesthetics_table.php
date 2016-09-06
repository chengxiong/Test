<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAestheticsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('aesthetics', function (Blueprint $table) {
      $table->increments('aid');
      $table->tinyInteger('channel');
      $table->string('title', 50);
      $table->string('subTitle', 100);
      $table->string('author', 50)->comment('作者');
      $table->tinyInteger('status');
      $table->integer('sort')->comment('排序');
      $table->tinyInteger('isTop')->comment('置顶');
      $table->integer('baseClickNum')->comment('阅读量基数');
      $table->integer('clickNum')->comment('阅读数');
      $table->dateTime('createTime')->comment('创建时间');
      $table->dateTime('updateTime')->comment('修改时间');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('aesthetics');
  }

}

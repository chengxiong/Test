<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomepageTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('homepage', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name', 30)->comment('名字');
      $table->string('subTitle1', 60)->comment('副标题1');
      $table->string('subTitle2', 30)->comment('副标题2');
      $table->tinyInteger('type')->comment('类型');
      $table->text('ids')->comment('编号列表');
      $table->string('imgs', 100)->comment('图片');
      $table->integer('sort')->comment('排序');
      $table->tinyInteger('status')->comment('状态');
      $table->dateTime('createTime')->comment('创建时间');
    });
  }
  
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('homepage');
  }

}

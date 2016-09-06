<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsercommentTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('usercomment', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('accountId')->comment('帐号id');
      $table->string('name', 30)->comment('用户姓名');
      $table->integer('cid')->comment('民宿id/美学id');
      $table->tinyInteger('type')->comment('类型');
      $table->tinyInteger('module')->comment('模块(1民宿/2美学)');
      $table->string('source', 16)->comment('来源');
      $table->tinyInteger('status')->comment('状态(1待审核/2审核通过)');
      $table->string('content', 500);
      $table->dateTime('createTime');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('usercomment');
  }

}

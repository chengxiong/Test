<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotwordTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {

    Schema::create('hotword', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name', 30);
      $table->tinyInteger('type')->comment('类型');
      $table->tinyInteger('sort')->comment('序号');
      $table->integer('hitnums')->comment('搜索量');
      $table->dateTime('createTime');
      $table->tinyInteger('status')->comment('上架状态');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('hotword');
  }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSleepImage extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('sleeper_image', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('sid')->index();
      $table->string('url', 200)->comment('图片地址');
      $table->string('type', 6)->comment('图片用途(person个人照片,photo摄影作品)');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('sleeper_image');
  }

}

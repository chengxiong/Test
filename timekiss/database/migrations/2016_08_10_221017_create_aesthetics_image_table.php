<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAestheticsImageTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('aesthetics_image', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('aid')->index();
      $table->string('url', 200)->comment('图片地址');
      $table->string('type', 6)->comment('图片用途(cover封面,album相册)');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('aesthetics_image');
  }

}

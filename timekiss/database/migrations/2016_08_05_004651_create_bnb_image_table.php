<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBnbImageTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('bnb_image', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('bid');
      $table->string('url', 200)->comment('图片地址');
      $table->string('type', 6)->comment('图片用途(cover封面,album相册)');
      $table->index('bid');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('bnb_image');
  }

}

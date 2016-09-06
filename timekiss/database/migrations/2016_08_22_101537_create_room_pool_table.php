<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomPoolTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    # 房间对应图片表
    Schema::create('rooms_image', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('rid')->index();
      $table->string('url')->comment('房间图片');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('rooms_image');
  }

}

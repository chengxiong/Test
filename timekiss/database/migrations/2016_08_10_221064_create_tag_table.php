<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {

    Schema::create('tag', function (Blueprint $table) {
      $table->increments('tid');
      $table->tinyInteger('type')->comment('tag的类型，1是地点2是逼格3是酒店类型');
      $table->string('name', 20);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('tag');
  }

}

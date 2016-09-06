<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBnbSleeperTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('bnb_sleeper', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('bid');
      $table->integer('accountId')->default('0')->comment('帐号id');
      $table->string('name', 50)->comment('试睡员姓名');
      $table->string('avatar', 200)->default('0')->comment('试睡员头像');
      $table->string('starsign', 10)->default('')->comment('试睡员星座');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('bnb_sleeper');
  }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserlikeTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('userlike', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('accountId')->comment('帐号id');
      $table->tinyInteger('type')->comment('(1民宿/2美学)');
      $table->integer('likeid');
      $table->dateTime('createTime');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('userlike');
  }

}

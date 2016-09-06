<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSleepSignTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('sleepsign', function (Blueprint $table) {
      $table->increments('id');
      $table->string('url', 200);
      $table->dateTime('createTime');
      $table->integer('crmUserId');
      $table->string('crmUserName', 30);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('sleepsign');
  }

}

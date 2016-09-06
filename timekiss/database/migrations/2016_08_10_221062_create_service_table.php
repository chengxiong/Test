<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {

    Schema::create('service', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name', 30);
      $table->string('image', 200);
      $table->dateTime('createTime');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('service');
  }

}

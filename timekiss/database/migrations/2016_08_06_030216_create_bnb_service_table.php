<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBnbServiceTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('bnb_service', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('bid'); # bnd id
      $table->integer('sid'); # service_id
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('bnb_service');
  }

}

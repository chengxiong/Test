<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBnbSimilarTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('bnb_similar', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('bid');
      $table->integer('sbid')->comment('相似民宿id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('bnb_similar');
  }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAestheticsSimilarTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('aesthetics_similar', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('aid');
      $table->integer('said');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('aesthetics_similar');
  }

}

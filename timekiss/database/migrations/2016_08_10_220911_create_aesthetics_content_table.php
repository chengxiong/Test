<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAestheticsContentTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('aesthetics_content', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('aid');
      $table->text('content');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('aesthetics_content');
  }

}

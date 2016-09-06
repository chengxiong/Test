<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBnbContentTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('bnb_content', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('bid');
      $table->text('content');
      $table->index('bid');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('bnb_content');
  }

}

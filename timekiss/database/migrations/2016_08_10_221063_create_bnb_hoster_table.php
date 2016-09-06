<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBnbHosterTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {

    Schema::create('bnb_hoster', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('bid')->comment('民宿');
      $table->integer('hid')->comment('房东');
      $table->string('role', 10)->comment('角色(1房东/2管家)');
      $table->integer('accountId')->default('0')->comment('账号');
      $table->dateTime('createTime');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('bnb_hoster');
  }

}

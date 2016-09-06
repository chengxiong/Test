<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppupgradeTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {

    Schema::create('appupgrade', function (Blueprint $table) {
      $table->increments('id');
      $table->tinyInteger('upgradeflag')->comment('升级标志(0不显示/1弱更新/2强更新/)');
      $table->string('version', 10)->comment('版本');
      $table->string('platform', 10)->comment('平台名称');
      $table->string('url', 200)->comment('帐号id');
      $table->string('title', 50);
      $table->string('description', 500);
      $table->integer('crmUserId');
      $table->string('crmUserName', 30);
      $table->dateTime('createTime');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('appupgrade');
  }

}

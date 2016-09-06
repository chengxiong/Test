<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountRoleModelsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('account_role', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('accountId');
      $table->string('role', 15); # 角色
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('account_role_models');
  }

}

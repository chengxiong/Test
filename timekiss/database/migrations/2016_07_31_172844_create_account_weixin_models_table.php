<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountWeixinModelsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('account_weixin', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('accountId');
      $table->string('WXopenid', 50)->comment('普通用户的标识，对当前开发者帐号唯一');
      $table->string('WXnickname', 20);
      $table->tinyInteger('WXsex')->comment('普通用户性别，1为男性，2为女性');
      $table->string('WXprovince', 20);
      $table->string('WXcity', 20);
      $table->string('WXcountry', 20);
      $table->string('WXheadimgurl', 200);
      $table->string('WXprivilege', 100)->comment('用户头像');
      $table->string('WXunionid', 50)->comment('用户统一标识。针对一个微信开放平台帐号下的应用，同一用户的unionid是唯一的');
      $table->dateTime('createAt');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('account_weixin_models');
  }

}

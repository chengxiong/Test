<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsVerificationTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('sms_verification', function (Blueprint $table) {
      $table->increments('id');
      $table->string('mobile', 20)->comment('手机号码')->index();
      $table->string('verificationCode', 20)->comment('校验码');
      $table->tinyInteger('type')->comment('(1注册,2找回密码)');
      $table->integer('lastSend')->comment('发送时间');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('sms_verification');
  }

}

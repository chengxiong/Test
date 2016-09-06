<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('message', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title', 100)->comment('标题');
      $table->string('subTitle', 100)->default('')->comment('标题');
      $table->string('content', 1000)->default('')->comment('内容');
      $table->string('otherContent', 1000)->default('')->comment('其他信息');
      $table->tinyInteger('type')->default('0')->comment('类型');
      $table->tinyInteger('status')->default('0')->comment('状态(2开启|1关闭)');
      $table->dateTime('createTime')->comment('创建时间');
    });

    Schema::create('message_read', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('accountId')->comment('帐号id');
      $table->integer('messageId')->comment('消息id');
      $table->dateTime('createTime')->comment('阅读时间');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('message');
  }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 房间价格
 */
class CreatePricetagTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('pricetag', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('rid')->comment('房间id'); # 房间id
      $table->double('price')->comment('价格'); # 价格
      $table->date('priceDate')->comment('时间');
      $table->tinyInteger('source')->comment('定价来源(1态客2房东)');
      $table->integer('actionUserId')->comment('操作人id');
      $table->timestamps();
      $table->index(['rid', 'priceDate']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('pricetag');
  }

}

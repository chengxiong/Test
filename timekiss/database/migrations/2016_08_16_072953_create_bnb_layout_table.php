<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBnbLayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bnb_layout', function (Blueprint $table) {
            $table->increments('id');
            # 关联民宿
            $table->integer('bid')->index();
            # 房型名称
            $table->string('name')->comment('房型名称');
            # 房型简介
            $table->string('introduction')->comment('房型简介');
            # 最大入住人数
            # 是否包房
            $table->timestamps();
        });
        
//        Schema::create('layout_image', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('lid')->index();
//            $table->string('url')->comment('房型图片');
//        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bnb_layout');
    }
}

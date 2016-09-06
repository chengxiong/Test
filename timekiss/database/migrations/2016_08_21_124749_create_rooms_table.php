<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # 房间表
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('bid')->index();
            $table->integer('tid')->index();
            $table->char('tkOwned',1)->default('0')->comment('0 没有包房 1 包房');           
            # 房型简介
            $table->string('introduction')->comment('房间简介');
            # 价格
            $table->float('price')->comment('价格');
            # 是否允许房东改价
            $table->char('changePrice')->defalut('0')->comment('房东是否可以价格 0 不可以 1可以');
            # 最大入住人数
            $table->string('number',1)->default('2')->comment('最大入住人数');
            # 房间最大面积
            $table->string('size')->comment('房间最大面积');
            # 床型
            $table->string('bed_type')->comment('床型');
            # 床宽
            $table->string('bed_width')->comment('床宽');
            # 房型状态(上下架)
            $table->char('status','1')->default('0')->comment('0 下架 1 上架');
            # check-in-time
            $table->string('checkInTime',10)->defalut('14:00')->comment('入住时间');
            # check-out-time
            $table->string('checkOutTime',10)->defalut('12:00')->comment('入住时间');
            # 早餐
            $table->char('breakfast')->defalut('0')->comment('是否有早餐 0 没有 1 有');
            # 接送
            $table->char('shuttle')->defalut('0')->comment('是否有接送 0 没有 1 有');
            # 态客
            $table->char('tk_wow')->defalut('0')->comment('态客WOW 0 没有 1 有');
            # 房间添加字段
            $table->timestamps();
        }); 
        
        # 预订表
        Schema::create('room_reserved', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bid');
            $table->integer('tid');
            $table->integer('rid');
            $table->integer('oid');
            $table->date('reservedDate');
            $table->char('status',1)->default('0');
            $table->char('source',1)->default('0');
            $table->timestamps();
            $table->index(['bid','rid','reservedDate']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rooms');
        Schema::drop('room_reserved');
    }
}

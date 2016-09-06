<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBnbAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bnb_account', function (Blueprint $table) {
            $table->integer('account_id')->unsigned();
            $table->integer('bnb_id')->unsigned();

            $table->foreign('account_id')->references('accountId')->on('account')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('bnb_id')->references('bid')->on('bnb')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['account_id', 'bnb_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bnb_account');
    }
}

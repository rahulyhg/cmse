<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTblOrderHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_by')->unsigned();
            $table->foreign('order_by')->references('id')->on('users');
            $table->integer('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
            $table->integer('cancelled_by')->unsigned()->nullable();
            $table->foreign('cancelled_by')->references('id')->on('users');
            $table->integer('ordered_from')->unsigned();
            $table->foreign('ordered_from')->references('id')->on('hospitals');
            $table->text('notes');
            $table->nullableTimestamps();
            $table->timestamp('approved_at');
            $table->timestamp('delivering_at');
            $table->timestamp('delivered_at');
            $table->timestamp('cancelled_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_headers');
    }
}

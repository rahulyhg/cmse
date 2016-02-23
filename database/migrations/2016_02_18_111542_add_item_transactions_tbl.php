<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemTransactionsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_code');
            $table->foreign('item_code')->references('item_code')->on('items');
            $table->string('transaction_type');
            $table->text('note');
            $table->decimal('cost',15,2);
            $table->decimal('quantity',15,2);
            $table->integer('transfer_to')->unsigned()->nullable();
            $table->foreign('transfer_to')->references('id')->on('hospitals');
            $table->integer('order_no')->unsigned()->nullable();
            $table->foreign('order_no')->references('id')->on('order_headers');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('hospital_id')->unsigned();
            $table->foreign('hospital_id')->references('id')->on('hospitals');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_transactions');
    }
}

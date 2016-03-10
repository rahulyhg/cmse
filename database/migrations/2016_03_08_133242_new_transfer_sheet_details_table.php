<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewTransferSheetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_sheet_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transfer_sheet_id')->unsigned();
            $table->foreign('transfer_sheet_id')->references('id')->on('transfer_sheet_headers');
            $table->string('item_code');
            $table->foreign('item_code')->references('item_code')->on('items');
            $table->decimal('quantity',15,2);
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
        Schema::drop('transfer_sheet_details');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransferSheetIdTblItemTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_transactions', function (Blueprint $table) {
            $table->integer('transfer_sheet_id')->unsigned()->nullable();
            $table->foreign('transfer_sheet_id')->references('id')->on('transfer_sheet_headers');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_transactions', function (Blueprint $table) {
            $table->dropForeign(['transfer_sheet_id']);
            $table->dropColumn('transfer_sheet_id');
        });
    }
}

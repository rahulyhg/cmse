<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUsageidItemTransactionsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_transactions', function (Blueprint $table) {
            $table->integer('usage_id')->unsigned()->nullable();
            $table->foreign('usage_id')->references('id')->on('usages');
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
            $table->dropForeign(['usage_id']);
            $table->dropColumn('usage_id');
        });
    }
}

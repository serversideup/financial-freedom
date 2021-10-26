<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedCategoryIdToTransactionsSplits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions_splits', function (Blueprint $table) {
            $table->bigInteger('category_id')->unsigned()->nullable()->after('transaction_id');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions_splits', function (Blueprint $table) {
            $table->dropForeign('transactions_splits_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
}

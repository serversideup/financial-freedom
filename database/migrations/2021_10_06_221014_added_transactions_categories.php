<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedTransactionsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function( Blueprint $table ){
            $table->bigInteger('category_id')->unsigned()->nullable()->after('accountable_type');
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
        Schema::table('transactions', function( Blueprint $table ){
            $table->dropForeign('transactions_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
}

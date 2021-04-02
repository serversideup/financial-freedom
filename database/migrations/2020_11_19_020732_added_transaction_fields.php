<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedTransactionFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function( Blueprint $table ){
            $table->date('date')->nullable()->after('amount');
            $table->string('name')->after('date');
            $table->text('description')->after('name');
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
            $table->dropColumn('date');
            $table->dropColumn('name');
            $table->dropColumn('description');
        });
    }
}

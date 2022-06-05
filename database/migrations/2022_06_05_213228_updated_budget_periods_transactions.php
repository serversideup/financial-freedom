<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets_periods_transactions', function( Blueprint $table ){
            $table->dropForeign('budgets_periods_transactions_budget_period_id_foreign');
            $table->foreign('budget_period_id')->references('id')->on('budgets_periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};

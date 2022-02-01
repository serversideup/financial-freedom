<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedGiftCardName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gift_cards', function( Blueprint $table ){
            $table->string('company')->after('user_id');
            $table->date('expiration')->nullable()->change();
            $table->text('url')->nullable()->change();
            $table->text('code')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gift_cards', function( Blueprint $table ){
            $table->dropColumn('company');
        });
    }
}

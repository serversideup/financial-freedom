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
        Schema::table('checking_accounts', function( $table ){
            $table->bigInteger('institution_import_map_id')->unsigned()->nullable()->after('institution_id');
            $table->foreign('institution_import_map_id')->references('id')->on('institutions_import_mappings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checking_accounts', function( $table ){
            $table->dropColumn('institution_import_map_id');
        });
    }
};

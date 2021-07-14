<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Included in version 0.1.1
 */
class AddedCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function( Blueprint $table ){
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('color');
            $table->timestamps();
        });

        Schema::table('categories', function( Blueprint $table ){
            $table->foreign('parent_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

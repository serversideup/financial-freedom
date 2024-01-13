<?php

use App\Models\User;
use App\Services\Categories\SeedUserCategories;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $users = User::all();

        foreach( $users as $user ){
            ( new SeedUserCategories() )->seed( $user );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};

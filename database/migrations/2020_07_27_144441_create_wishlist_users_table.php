<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('wishlist_users')) {
            Schema::create('wishlist_users', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('wishlist_id');
                $table->unsignedBigInteger('user_id');

                $table->foreign('wishlist_id')->references('id')->on('wishlists')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('wishlist_users')) {
            Schema::dropIfExists('wishlist_users');
        }
    }
}

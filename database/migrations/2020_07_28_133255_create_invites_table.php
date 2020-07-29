<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('invites')) {
            Schema::create('invites', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('wishlist_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('email');
                $table->boolean('sent')->default(0);

                $table->foreign('wishlist_id')->references('id')->on('wishlists')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**s
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('invites')) {
            Schema::dropIfExists('invites');
        }
    }
}

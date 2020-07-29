<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('wishlist_items')) {
            Schema::create('wishlist_items', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('wishlist_id');
                $table->unsignedBigInteger('buyer_id')->nullable();
                $table->string('name');
                $table->text('description')->nullable();
                $table->decimal('price', 19, 2);
                $table->string('img_url')->nullable();
                $table->string('shop_url')->nullable();
                $table->boolean('purchased')->default(0);
                $table->timestamps();

                $table->foreign('wishlist_id')->references('id')->on('wishlists')->onDelete('cascade');
                $table->foreign('buyer_id')->references('id')->on('users')->onDelete('set null');
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
        if (Schema::hasTable('wishlist_items')) {
            Schema::dropIfExists('wishlist_items');
        }
    }
}

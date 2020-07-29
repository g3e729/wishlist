<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Wishlist;
use Illuminate\Support\Str;
use App\Models\WishlistItem;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(WishlistItem::class, function (Faker $faker) {

	$wishlist = factory(Wishlist::class)->create();

    return [
		'wishlist_id' => $wishlist->id,
		'name' => $faker->word,
		'description' => $faker->paragraph,
		'price' => rand(1, 1000),
		'img_url' => '',
		'shop_url' => ''
    ];
});

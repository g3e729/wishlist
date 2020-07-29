<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Str;
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

$factory->define(Wishlist::class, function (Faker $faker) {

	$user = factory(User::class)->create();

    return [
		'title' => $faker->word,
		'description' => $faker->paragraph,
		'organizer_id' => $user->id
    ];
});

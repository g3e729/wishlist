<?php

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
    	for ($i = 0; $i != 10; $i++) {
	    	User::create([
		        'name' => $faker->name,
		        'email' => $faker->unique()->safeEmail,
		        'password' => 'password'
	    	]);
    	}
    }
}

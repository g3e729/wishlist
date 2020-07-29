<?php

use App\Models\User;
use App\Models\Wishlist;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
	protected $faker = [];
	protected $invited = [];

	public function __construct(Faker $faker)
	{
		$this->faker = $faker;
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i = 0; $i != 10; $i++) {
    		$this->invited = [];
    		$this->organizer_id = User::get()->random()->id;

	    	$wishlist = Wishlist::create([
		        'title' => $this->faker->word,
				'description' => $this->faker->paragraph,
				'organizer_id' => $this->organizer_id
	    	]);

	    	$this->storeItem($wishlist);
	    	$this->invite($wishlist);
    	}
    }

    private function storeItem($wishlist)
    {
    	$wishlist->wishes()->firstOrCreate([
			'name' => $this->faker->word,
			'description' => $this->faker->paragraph,
			'price' => rand(1, 1000),
			'img_url' => 'https://i.imgur.com/JTkWiub.jpeg',
			'shop_url' => $this->faker->url
    	]);

    	if (rand(0, 20) > 0) {
    		$this->storeItem($wishlist);
    	}

    	return;
    }

    private function invite($wishlist)
    {
    	$user = User::where('id', '!=', $this->organizer_id)->get()->random();
    	$this->invited[] = $user->id;

    	$wishlist->participants()->attach($user->id);

    	if (rand(0, 1)) {
    		$this->invite($wishlist);
    	}

    	return;
    }
}
